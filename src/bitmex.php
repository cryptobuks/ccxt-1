<?php

namespace ccxt;

class bitmex extends Exchange {

    public function describe () {
        return array_replace_recursive (parent::describe (), array (
            'id' => 'bitmex',
            'name' => 'BitMEX',
            'countries' => 'SC', // Seychelles
            'version' => 'v1',
            'userAgent' => null,
            'rateLimit' => 2000,
            'has' => array (
                'CORS' => false,
                'fetchOHLCV' => true,
                'withdraw' => true,
                'editOrder' => true,
                'fetchOrder' => true,
                'fetchOrders' => true,
                'fetchOpenOrders' => true,
                'fetchClosedOrders' => true,
            ),
            'timeframes' => array (
                '1m' => '1m',
                '5m' => '5m',
                '1h' => '1h',
                '1d' => '1d',
            ),
            'urls' => array (
                'test' => 'https://testnet.bitmex.com',
                'logo' => 'https://user-images.githubusercontent.com/1294454/27766319-f653c6e6-5ed4-11e7-933d-f0bc3699ae8f.jpg',
                'api' => 'https://www.bitmex.com',
                'www' => 'https://www.bitmex.com',
                'doc' => array (
                    'https://www.bitmex.com/app/apiOverview',
                    'https://github.com/BitMEX/api-connectors/tree/master/official-http',
                ),
            ),
            'api' => array (
                'public' => array (
                    'get' => array (
                        'announcement',
                        'announcement/urgent',
                        'funding',
                        'instrument',
                        'instrument/active',
                        'instrument/activeAndIndices',
                        'instrument/activeIntervals',
                        'instrument/compositeIndex',
                        'instrument/indices',
                        'insurance',
                        'leaderboard',
                        'liquidation',
                        'orderBook',
                        'orderBook/L2',
                        'quote',
                        'quote/bucketed',
                        'schema',
                        'schema/websocketHelp',
                        'settlement',
                        'stats',
                        'stats/history',
                        'trade',
                        'trade/bucketed',
                    ),
                ),
                'private' => array (
                    'get' => array (
                        'apiKey',
                        'chat',
                        'chat/channels',
                        'chat/connected',
                        'execution',
                        'execution/tradeHistory',
                        'notification',
                        'order',
                        'position',
                        'user',
                        'user/affiliateStatus',
                        'user/checkReferralCode',
                        'user/commission',
                        'user/depositAddress',
                        'user/margin',
                        'user/minWithdrawalFee',
                        'user/wallet',
                        'user/walletHistory',
                        'user/walletSummary',
                    ),
                    'post' => array (
                        'apiKey',
                        'apiKey/disable',
                        'apiKey/enable',
                        'chat',
                        'order',
                        'order/bulk',
                        'order/cancelAllAfter',
                        'order/closePosition',
                        'position/isolate',
                        'position/leverage',
                        'position/riskLimit',
                        'position/transferMargin',
                        'user/cancelWithdrawal',
                        'user/confirmEmail',
                        'user/confirmEnableTFA',
                        'user/confirmWithdrawal',
                        'user/disableTFA',
                        'user/logout',
                        'user/logoutAll',
                        'user/preferences',
                        'user/requestEnableTFA',
                        'user/requestWithdrawal',
                    ),
                    'put' => array (
                        'order',
                        'order/bulk',
                        'user',
                    ),
                    'delete' => array (
                        'apiKey',
                        'order',
                        'order/all',
                    ),
                ),
            ),
        ));
    }

    public function fetch_markets () {
        $markets = $this->publicGetInstrumentActiveAndIndices ();
        $result = array ();
        for ($p = 0; $p < count ($markets); $p++) {
            $market = $markets[$p];
            $active = ($market['state'] !== 'Unlisted');
            $id = $market['symbol'];
            $base = $market['underlying'];
            $quote = $market['quoteCurrency'];
            $type = null;
            $future = false;
            $prediction = false;
            $basequote = $base . $quote;
            $base = $this->common_currency_code($base);
            $quote = $this->common_currency_code($quote);
            $swap = ($id === $basequote);
            $symbol = $id;
            if ($swap) {
                $type = 'swap';
                $symbol = $base . '/' . $quote;
            } else if (mb_strpos ($id, 'B_') !== false) {
                $prediction = true;
                $type = 'prediction';
            } else {
                $future = true;
                $type = 'future';
            }
            $maker = $market['makerFee'];
            $taker = $market['takerFee'];
            $result[] = array (
                'id' => $id,
                'symbol' => $symbol,
                'base' => $base,
                'quote' => $quote,
                'active' => $active,
                'taker' => $taker,
                'maker' => $maker,
                'type' => $type,
                'spot' => false,
                'swap' => $swap,
                'future' => $future,
                'prediction' => $prediction,
                'info' => $market,
            );
        }
        return $result;
    }

    public function fetch_balance ($params = array ()) {
        $this->load_markets();
        $response = $this->privateGetUserMargin (array ( 'currency' => 'all' ));
        $result = array ( 'info' => $response );
        for ($b = 0; $b < count ($response); $b++) {
            $balance = $response[$b];
            $currency = strtoupper ($balance['currency']);
            $currency = $this->common_currency_code($currency);
            $account = array (
                'free' => $balance['availableMargin'],
                'used' => 0.0,
                'total' => $balance['marginBalance'],
            );
            if ($currency === 'BTC') {
                $account['free'] = $account['free'] * 0.00000001;
                $account['total'] = $account['total'] * 0.00000001;
            }
            $account['used'] = $account['total'] - $account['free'];
            $result[$currency] = $account;
        }
        return $this->parse_balance($result);
    }

    public function fetch_order_book ($symbol, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = $this->market ($symbol);
        $request = array (
            'symbol' => $market['id'],
        );
        if ($limit !== null)
            $request['depth'] = $limit;
        $orderbook = $this->publicGetOrderBookL2 (array_merge ($request, $params));
        $timestamp = $this->milliseconds ();
        $result = array (
            'bids' => array (),
            'asks' => array (),
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
        );
        for ($o = 0; $o < count ($orderbook); $o++) {
            $order = $orderbook[$o];
            $side = ($order['side'] === 'Sell') ? 'asks' : 'bids';
            $amount = $order['size'];
            $price = $order['price'];
            $result[$side][] = array ( $price, $amount );
        }
        $result['bids'] = $this->sort_by($result['bids'], 0, true);
        $result['asks'] = $this->sort_by($result['asks'], 0);
        return $result;
    }

    public function fetch_order ($id, $symbol = null, $params = array ()) {
        $filter = array ( 'filter' => array ( 'orderID' => $id ));
        $result = $this->fetch_orders($symbol, null, null, array_replace_recursive ($filter, $params));
        $numResults = is_array ($result) ? count ($result) : 0;
        if ($numResults === 1)
            return $result[0];
        throw new OrderNotFound ($this->id . ' => The order ' . $id . ' not found.');
    }

    public function fetch_orders ($symbol = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = null;
        $request = array ();
        if ($symbol !== null) {
            $market = $this->market ($symbol);
            $request['symbol'] = $market['id'];
        }
        if ($since !== null)
            $request['startTime'] = $this->iso8601 ($since);
        if ($limit !== null)
            $request['count'] = $limit;
        $request = array_replace_recursive ($request, $params);
        // why the hassle? urlencode in python is kinda broken for nested dicts.
        // E.g. self.urlencode(array ("filter" => array ("open" => True))) will return "filter=array ('open':+True)"
        // Bitmex doesn't like that. Hence resorting to this hack.
        if (is_array ($request) && array_key_exists ('filter', $request))
            $request['filter'] = $this->json ($request['filter']);
        $response = $this->privateGetOrder ($request);
        return $this->parse_orders($response, $market, $since, $limit);
    }

    public function fetch_open_orders ($symbol = null, $since = null, $limit = null, $params = array ()) {
        $filter_params = array ( 'filter' => array ( 'open' => true ));
        return $this->fetch_orders($symbol, $since, $limit, array_replace_recursive ($filter_params, $params));
    }

    public function fetch_closed_orders ($symbol = null, $since = null, $limit = null, $params = array ()) {
        // Bitmex barfs if you set 'open' => false in the filter...
        $orders = $this->fetch_orders($symbol, $since, $limit, $params);
        return $this->filter_by($orders, 'status', 'closed');
    }

    public function fetch_ticker ($symbol, $params = array ()) {
        $this->load_markets();
        $market = $this->market ($symbol);
        if (!$market['active'])
            throw new ExchangeError ($this->id . ' => $symbol ' . $symbol . ' is delisted');
        $request = array_merge (array (
            'symbol' => $market['id'],
            'binSize' => '1d',
            'partial' => true,
            'count' => 1,
            'reverse' => true,
        ), $params);
        $quotes = $this->publicGetQuoteBucketed ($request);
        $quotesLength = is_array ($quotes) ? count ($quotes) : 0;
        $quote = $quotes[$quotesLength - 1];
        $tickers = $this->publicGetTradeBucketed ($request);
        $ticker = $tickers[0];
        $timestamp = $this->milliseconds ();
        $open = $this->safe_float($ticker, 'open');
        $close = $this->safe_float($ticker, 'close');
        $change = $close - $open;
        return array (
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
            'high' => floatval ($ticker['high']),
            'low' => floatval ($ticker['low']),
            'bid' => floatval ($quote['bidPrice']),
            'bidVolume' => null,
            'ask' => floatval ($quote['askPrice']),
            'askVolume' => null,
            'vwap' => floatval ($ticker['vwap']),
            'open' => $open,
            'close' => $close,
            'last' => $close,
            'previousClose' => null,
            'change' => $change,
            'percentage' => $change / $open * 100,
            'average' => $this->sum ($open, $close) / 2,
            'baseVolume' => floatval ($ticker['homeNotional']),
            'quoteVolume' => floatval ($ticker['foreignNotional']),
            'info' => $ticker,
        );
    }

    public function parse_ohlcv ($ohlcv, $market = null, $timeframe = '1m', $since = null, $limit = null) {
        $timestamp = $this->parse8601 ($ohlcv['timestamp']);
        return [
            $timestamp,
            $ohlcv['open'],
            $ohlcv['high'],
            $ohlcv['low'],
            $ohlcv['close'],
            $ohlcv['volume'],
        ];
    }

    public function fetch_ohlcv ($symbol, $timeframe = '1m', $since = null, $limit = 100, $params = array ()) {
        $this->load_markets();
        // send JSON key/value pairs, such as array ("key" => "value")
        // $filter by individual fields and do advanced queries on timestamps
        // $filter = array ( 'key' => 'value' );
        // send a bare series (e.g. XBU) to nearest expiring contract in that series
        // you can also send a $timeframe, e.g. XBU:monthly
        // timeframes => daily, weekly, monthly, quarterly, and biquarterly
        $market = $this->market ($symbol);
        $request = array (
            'symbol' => $market['id'],
            'binSize' => $this->timeframes[$timeframe],
            'partial' => true,     // true == include yet-incomplete current bins
            'count' => $limit,      // default 100, max 500
            // 'filter' => $filter, // $filter by individual fields and do advanced queries
            // 'columns' => array (),    // will return all columns if omitted
            // 'start' => 0,       // starting point for results (wtf?)
            // 'reverse' => false, // true == newest first
            // 'endTime' => '',    // ending date $filter for results
        );
        // if $since is not set, they will return candles starting from 2017-01-01
        if ($since !== null) {
            $ymdhms = $this->ymdhms ($since);
            $ymdhm = mb_substr ($ymdhms, 0, 16);
            $request['startTime'] = $ymdhm; // starting date $filter for results
        }
        $response = $this->publicGetTradeBucketed (array_merge ($request, $params));
        return $this->parse_ohlcvs($response, $market, $timeframe, $since, $limit);
    }

    public function parse_trade ($trade, $market = null) {
        $timestamp = $this->parse8601 ($trade['timestamp']);
        $symbol = null;
        if (!$market) {
            if (is_array ($trade) && array_key_exists ('symbol', $trade))
                $market = $this->markets_by_id[$trade['symbol']];
        }
        if ($market)
            $symbol = $market['symbol'];
        return array (
            'id' => $trade['trdMatchID'],
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
            'symbol' => $symbol,
            'order' => null,
            'type' => null,
            'side' => strtolower ($trade['side']),
            'price' => $trade['price'],
            'amount' => $trade['size'],
        );
    }

    public function parse_order_status ($status) {
        $statuses = array (
            'new' => 'open',
            'partiallyfilled' => 'open',
            'filled' => 'closed',
            'canceled' => 'canceled',
            'rejected' => 'rejected',
            'expired' => 'expired',
        );
        return $this->safe_string($statuses, strtolower ($status));
    }

    public function parse_order ($order, $market = null) {
        $status = $this->safe_value($order, 'ordStatus');
        if ($status !== null)
            $status = $this->parse_order_status($status);
        $symbol = null;
        if ($market) {
            $symbol = $market['symbol'];
        } else {
            $id = $order['symbol'];
            if (is_array ($this->markets_by_id) && array_key_exists ($id, $this->markets_by_id)) {
                $market = $this->markets_by_id[$id];
                $symbol = $market['symbol'];
            }
        }
        $datetime_value = null;
        $timestamp = null;
        $iso8601 = null;
        if (is_array ($order) && array_key_exists ('timestamp', $order))
            $datetime_value = $order['timestamp'];
        else if (is_array ($order) && array_key_exists ('transactTime', $order))
            $datetime_value = $order['transactTime'];
        if ($datetime_value !== null) {
            $timestamp = $this->parse8601 ($datetime_value);
            $iso8601 = $this->iso8601 ($timestamp);
        }
        $price = $this->safe_float($order, 'price');
        $amount = floatval ($order['orderQty']);
        $filled = $this->safe_float($order, 'cumQty', 0.0);
        $remaining = max ($amount - $filled, 0.0);
        $cost = null;
        if ($price !== null)
            if ($filled !== null)
                $cost = $price * $filled;
        $result = array (
            'info' => $order,
            'id' => (string) $order['orderID'],
            'timestamp' => $timestamp,
            'datetime' => $iso8601,
            'symbol' => $symbol,
            'type' => strtolower ($order['ordType']),
            'side' => strtolower ($order['side']),
            'price' => $price,
            'amount' => $amount,
            'cost' => $cost,
            'filled' => $filled,
            'remaining' => $remaining,
            'status' => $status,
            'fee' => null,
        );
        return $result;
    }

    public function fetch_trades ($symbol, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = $this->market ($symbol);
        $request = array (
            'symbol' => $market['id'],
        );
        if ($since !== null)
            $request['startTime'] = $this->iso8601 ($since);
        if ($limit !== null)
            $request['count'] = $limit;
        $response = $this->publicGetTrade (array_merge ($request, $params));
        return $this->parse_trades($response, $market);
    }

    public function create_order ($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        $this->load_markets();
        $request = array (
            'symbol' => $this->market_id($symbol),
            'side' => $this->capitalize ($side),
            'orderQty' => $amount,
            'ordType' => $this->capitalize ($type),
        );
        if ($type === 'limit')
            $request['price'] = $price;
        $response = $this->privatePostOrder (array_merge ($request, $params));
        $order = $this->parse_order($response);
        $id = $order['id'];
        $this->orders[$id] = $order;
        return array_merge (array ( 'info' => $response ), $order);
    }

    public function edit_order ($id, $symbol, $type, $side, $amount = null, $price = null, $params = array ()) {
        $this->load_markets();
        $request = array (
            'orderID' => $id,
        );
        if ($amount !== null)
            $request['orderQty'] = $amount;
        if ($price !== null)
            $request['price'] = $price;
        $response = $this->privatePutOrder (array_merge ($request, $params));
        $order = $this->parse_order($response);
        $this->orders[$order['id']] = $order;
        return array_merge (array ( 'info' => $response ), $order);
    }

    public function cancel_order ($id, $symbol = null, $params = array ()) {
        $this->load_markets();
        $response = $this->privateDeleteOrder (array_merge (array ( 'orderID' => $id ), $params));
        $order = $response[0];
        $error = $this->safe_string($order, 'error');
        if ($error !== null)
            if (mb_strpos ($error, 'Unable to cancel $order due to existing state') !== false)
                throw new OrderNotFound ($this->id . ' cancelOrder() failed => ' . $error);
        $order = $this->parse_order($order);
        $this->orders[$order['id']] = $order;
        return array_merge (array ( 'info' => $response ), $order);
    }

    public function is_fiat ($currency) {
        if ($currency === 'EUR')
            return true;
        if ($currency === 'PLN')
            return true;
        return false;
    }

    public function withdraw ($currency, $amount, $address, $tag = null, $params = array ()) {
        $this->check_address($address);
        $this->load_markets();
        if ($currency !== 'BTC')
            throw new ExchangeError ($this->id . ' supoprts BTC withdrawals only, other currencies coming soon...');
        $request = array (
            'currency' => 'XBt', // temporarily
            'amount' => $amount,
            'address' => $address,
            // 'otpToken' => '123456', // requires if two-factor auth (OTP) is enabled
            // 'fee' => 0.001, // bitcoin network fee
        );
        $response = $this->privatePostUserRequestWithdrawal (array_merge ($request, $params));
        return array (
            'info' => $response,
            'id' => $response['transactID'],
        );
    }

    public function handle_errors ($code, $reason, $url, $method, $headers, $body) {
        if ($code === 429)
            throw new DDoSProtection ($this->id . ' ' . $body);
        if ($code >= 400) {
            if ($body) {
                if ($body[0] === '{') {
                    $response = json_decode ($body, $as_associative_array = true);
                    if (is_array ($response) && array_key_exists ('error', $response)) {
                        if (is_array ($response['error']) && array_key_exists ('message', $response['error'])) {
                            $message = $this->safe_value($response['error'], 'message');
                            if ($message !== null) {
                                if ($message === 'Invalid API Key.')
                                    throw new AuthenticationError ($this->id . ' ' . $this->json ($response));
                            }
                            // stub $code, need proper handling
                            throw new ExchangeError ($this->id . ' ' . $this->json ($response));
                        }
                    }
                }
            }
        }
    }

    public function nonce () {
        return $this->milliseconds ();
    }

    public function sign ($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $query = '/api' . '/' . $this->version . '/' . $path;
        if ($method !== 'PUT')
            if ($params)
                $query .= '?' . $this->urlencode ($params);
        $url = $this->urls['api'] . $query;
        if ($api === 'private') {
            $this->check_required_credentials();
            $nonce = (string) $this->nonce ();
            $auth = $method . $query . $nonce;
            if ($method === 'POST' || $method === 'PUT') {
                if ($params) {
                    $body = $this->json ($params);
                    $auth .= $body;
                }
            }
            $headers = array (
                'Content-Type' => 'application/json',
                'api-nonce' => $nonce,
                'api-key' => $this->apiKey,
                'api-signature' => $this->hmac ($this->encode ($auth), $this->encode ($this->secret)),
            );
        }
        return array ( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }
}

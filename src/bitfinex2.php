<?php

namespace ccxt;

class bitfinex2 extends bitfinex {

    public function describe () {
        return array_replace_recursive (parent::describe (), array (
            'id' => 'bitfinex2',
            'name' => 'Bitfinex v2',
            'countries' => 'VG',
            'version' => 'v2',
            // new metainfo interface
            'has' => array (
                'CORS' => true,
                'createOrder' => false,
                'fetchMyTrades' => false,
                'fetchOHLCV' => true,
                'fetchTickers' => true,
                'fetchOrder' => true,
                'fetchOpenOrders' => false,
                'fetchClosedOrders' => false,
                'withdraw' => true,
                'deposit' => false,
            ),
            'timeframes' => array (
                '1m' => '1m',
                '5m' => '5m',
                '15m' => '15m',
                '30m' => '30m',
                '1h' => '1h',
                '3h' => '3h',
                '6h' => '6h',
                '12h' => '12h',
                '1d' => '1D',
                '1w' => '7D',
                '2w' => '14D',
                '1M' => '1M',
            ),
            'rateLimit' => 1500,
            'urls' => array (
                'logo' => 'https://user-images.githubusercontent.com/1294454/27766244-e328a50c-5ed2-11e7-947b-041416579bb3.jpg',
                'api' => 'https://api.bitfinex.com',
                'www' => 'https://www.bitfinex.com',
                'doc' => array (
                    'https://bitfinex.readme.io/v2/docs',
                    'https://github.com/bitfinexcom/bitfinex-api-node',
                ),
                'fees' => 'https://www.bitfinex.com/fees',
            ),
            'api' => array (
                'public' => array (
                    'get' => array (
                        'platform/status',
                        'tickers',
                        'ticker/{symbol}',
                        'trades/{symbol}/hist',
                        'book/{symbol}/{precision}',
                        'book/{symbol}/P0',
                        'book/{symbol}/P1',
                        'book/{symbol}/P2',
                        'book/{symbol}/P3',
                        'book/{symbol}/R0',
                        'stats1/{key}:{size}:{symbol}/{side}/{section}',
                        'stats1/{key}:{size}:{symbol}/long/last',
                        'stats1/{key}:{size}:{symbol}/long/hist',
                        'stats1/{key}:{size}:{symbol}/short/last',
                        'stats1/{key}:{size}:{symbol}/short/hist',
                        'candles/trade:{timeframe}:{symbol}/{section}',
                        'candles/trade:{timeframe}:{symbol}/last',
                        'candles/trade:{timeframe}:{symbol}/hist',
                    ),
                    'post' => array (
                        'calc/trade/avg',
                    ),
                ),
                'private' => array (
                    'post' => array (
                        'auth/r/wallets',
                        'auth/r/orders/{symbol}',
                        'auth/r/orders/{symbol}/new',
                        'auth/r/orders/{symbol}/hist',
                        'auth/r/order/{symbol}:{id}/trades',
                        'auth/r/trades/{symbol}/hist',
                        'auth/r/positions',
                        'auth/r/funding/offers/{symbol}',
                        'auth/r/funding/offers/{symbol}/hist',
                        'auth/r/funding/loans/{symbol}',
                        'auth/r/funding/loans/{symbol}/hist',
                        'auth/r/funding/credits/{symbol}',
                        'auth/r/funding/credits/{symbol}/hist',
                        'auth/r/funding/trades/{symbol}/hist',
                        'auth/r/info/margin/{key}',
                        'auth/r/info/funding/{key}',
                        'auth/r/movements/{currency}/hist',
                        'auth/r/stats/perf:{timeframe}/hist',
                        'auth/r/alerts',
                        'auth/w/alert/set',
                        'auth/w/alert/{type}:{symbol}:{price}/del',
                        'auth/calc/order/avail',
                    ),
                ),
            ),
            'markets' => array (
                'AVT/BTC' => array ( 'id' => 'tAVTBTC', 'symbol' => 'AVT/BTC', 'base' => 'AVT', 'quote' => 'BTC', 'baseId' => 'tAVT', 'quoteId' => 'tBTC' ),
                'AVT/ETH' => array ( 'id' => 'tAVTETH', 'symbol' => 'AVT/ETH', 'base' => 'AVT', 'quote' => 'ETH', 'baseId' => 'tAVT', 'quoteId' => 'tETH' ),
                'AVT/USD' => array ( 'id' => 'tAVTUSD', 'symbol' => 'AVT/USD', 'base' => 'AVT', 'quote' => 'USD', 'baseId' => 'tAVT', 'quoteId' => 'zUSD' ),
                'BCH/BTC' => array ( 'id' => 'tBCHBTC', 'symbol' => 'BCH/BTC', 'base' => 'BCH', 'quote' => 'BTC', 'baseId' => 'tBCH', 'quoteId' => 'tBTC' ),
                'BCH/ETH' => array ( 'id' => 'tBCHETH', 'symbol' => 'BCH/ETH', 'base' => 'BCH', 'quote' => 'ETH', 'baseId' => 'tBCH', 'quoteId' => 'tETH' ),
                'BCH/USD' => array ( 'id' => 'tBCHUSD', 'symbol' => 'BCH/USD', 'base' => 'BCH', 'quote' => 'USD', 'baseId' => 'tBCH', 'quoteId' => 'zUSD' ),
                'BTC/USD' => array ( 'id' => 'tBTCUSD', 'symbol' => 'BTC/USD', 'base' => 'BTC', 'quote' => 'USD', 'baseId' => 'tBTC', 'quoteId' => 'zUSD' ),
                'BTC/EUR' => array ( 'id' => 'tBTCEUR', 'symbol' => 'BTC/EUR', 'base' => 'BTC', 'quote' => 'EUR', 'baseId' => 'tBTC', 'quoteId' => 'zEUR' ),
                'BTG/BTC' => array ( 'id' => 'tBTGBTC', 'symbol' => 'BTG/BTC', 'base' => 'BTG', 'quote' => 'BTC', 'baseId' => 'tBTG', 'quoteId' => 'tBTC' ),
                'BTG/USD' => array ( 'id' => 'tBTGUSD', 'symbol' => 'BTG/USD', 'base' => 'BTG', 'quote' => 'USD', 'baseId' => 'tBTG', 'quoteId' => 'zUSD' ),
                'DASH/BTC' => array ( 'id' => 'tDSHBTC', 'symbol' => 'DASH/BTC', 'base' => 'DASH', 'quote' => 'BTC', 'baseId' => 'tDASH', 'quoteId' => 'tBTC' ),
                'DASH/USD' => array ( 'id' => 'tDSHUSD', 'symbol' => 'DASH/USD', 'base' => 'DASH', 'quote' => 'USD', 'baseId' => 'tDASH', 'quoteId' => 'zUSD' ),
                'DAT/BTC' => array ( 'id' => 'tDATBTC', 'symbol' => 'DAT/BTC', 'base' => 'DAT', 'quote' => 'BTC', 'baseId' => 'tDAT', 'quoteId' => 'tBTC' ),
                'DAT/ETH' => array ( 'id' => 'tDATETH', 'symbol' => 'DAT/ETH', 'base' => 'DAT', 'quote' => 'ETH', 'baseId' => 'tDAT', 'quoteId' => 'tETH' ),
                'DAT/USD' => array ( 'id' => 'tDATUSD', 'symbol' => 'DAT/USD', 'base' => 'DAT', 'quote' => 'USD', 'baseId' => 'tDAT', 'quoteId' => 'zUSD' ),
                'EDO/BTC' => array ( 'id' => 'tEDOBTC', 'symbol' => 'EDO/BTC', 'base' => 'EDO', 'quote' => 'BTC', 'baseId' => 'tEDO', 'quoteId' => 'tBTC' ),
                'EDO/ETH' => array ( 'id' => 'tEDOETH', 'symbol' => 'EDO/ETH', 'base' => 'EDO', 'quote' => 'ETH', 'baseId' => 'tEDO', 'quoteId' => 'tETH' ),
                'EDO/USD' => array ( 'id' => 'tEDOUSD', 'symbol' => 'EDO/USD', 'base' => 'EDO', 'quote' => 'USD', 'baseId' => 'tEDO', 'quoteId' => 'zUSD' ),
                'EOS/BTC' => array ( 'id' => 'tEOSBTC', 'symbol' => 'EOS/BTC', 'base' => 'EOS', 'quote' => 'BTC', 'baseId' => 'tEOS', 'quoteId' => 'tBTC' ),
                'EOS/ETH' => array ( 'id' => 'tEOSETH', 'symbol' => 'EOS/ETH', 'base' => 'EOS', 'quote' => 'ETH', 'baseId' => 'tEOS', 'quoteId' => 'tETH' ),
                'EOS/USD' => array ( 'id' => 'tEOSUSD', 'symbol' => 'EOS/USD', 'base' => 'EOS', 'quote' => 'USD', 'baseId' => 'tEOS', 'quoteId' => 'zUSD' ),
                'ETC/BTC' => array ( 'id' => 'tETCBTC', 'symbol' => 'ETC/BTC', 'base' => 'ETC', 'quote' => 'BTC', 'baseId' => 'tETC', 'quoteId' => 'tBTC' ),
                'ETC/USD' => array ( 'id' => 'tETCUSD', 'symbol' => 'ETC/USD', 'base' => 'ETC', 'quote' => 'USD', 'baseId' => 'tETC', 'quoteId' => 'zUSD' ),
                'ETH/BTC' => array ( 'id' => 'tETHBTC', 'symbol' => 'ETH/BTC', 'base' => 'ETH', 'quote' => 'BTC', 'baseId' => 'tETH', 'quoteId' => 'tBTC' ),
                'ETH/USD' => array ( 'id' => 'tETHUSD', 'symbol' => 'ETH/USD', 'base' => 'ETH', 'quote' => 'USD', 'baseId' => 'tETH', 'quoteId' => 'zUSD' ),
                'ETP/BTC' => array ( 'id' => 'tETPBTC', 'symbol' => 'ETP/BTC', 'base' => 'ETP', 'quote' => 'BTC', 'baseId' => 'tETP', 'quoteId' => 'tBTC' ),
                'ETP/ETH' => array ( 'id' => 'tETPETH', 'symbol' => 'ETP/ETH', 'base' => 'ETP', 'quote' => 'ETH', 'baseId' => 'tETP', 'quoteId' => 'tETH' ),
                'ETP/USD' => array ( 'id' => 'tETPUSD', 'symbol' => 'ETP/USD', 'base' => 'ETP', 'quote' => 'USD', 'baseId' => 'tETP', 'quoteId' => 'zUSD' ),
                'IOTA/BTC' => array ( 'id' => 'tIOTBTC', 'symbol' => 'IOTA/BTC', 'base' => 'IOTA', 'quote' => 'BTC', 'baseId' => 'tIOTA', 'quoteId' => 'tBTC' ),
                'IOTA/ETH' => array ( 'id' => 'tIOTETH', 'symbol' => 'IOTA/ETH', 'base' => 'IOTA', 'quote' => 'ETH', 'baseId' => 'tIOTA', 'quoteId' => 'tETH' ),
                'IOTA/USD' => array ( 'id' => 'tIOTUSD', 'symbol' => 'IOTA/USD', 'base' => 'IOTA', 'quote' => 'USD', 'baseId' => 'tIOTA', 'quoteId' => 'zUSD' ),
                'LTC/BTC' => array ( 'id' => 'tLTCBTC', 'symbol' => 'LTC/BTC', 'base' => 'LTC', 'quote' => 'BTC', 'baseId' => 'tLTC', 'quoteId' => 'tBTC' ),
                'LTC/USD' => array ( 'id' => 'tLTCUSD', 'symbol' => 'LTC/USD', 'base' => 'LTC', 'quote' => 'USD', 'baseId' => 'tLTC', 'quoteId' => 'zUSD' ),
                'NEO/BTC' => array ( 'id' => 'tNEOBTC', 'symbol' => 'NEO/BTC', 'base' => 'NEO', 'quote' => 'BTC', 'baseId' => 'tNEO', 'quoteId' => 'tBTC' ),
                'NEO/ETH' => array ( 'id' => 'tNEOETH', 'symbol' => 'NEO/ETH', 'base' => 'NEO', 'quote' => 'ETH', 'baseId' => 'tNEO', 'quoteId' => 'tETH' ),
                'NEO/USD' => array ( 'id' => 'tNEOUSD', 'symbol' => 'NEO/USD', 'base' => 'NEO', 'quote' => 'USD', 'baseId' => 'tNEO', 'quoteId' => 'zUSD' ),
                'OMG/BTC' => array ( 'id' => 'tOMGBTC', 'symbol' => 'OMG/BTC', 'base' => 'OMG', 'quote' => 'BTC', 'baseId' => 'tOMG', 'quoteId' => 'tBTC' ),
                'OMG/ETH' => array ( 'id' => 'tOMGETH', 'symbol' => 'OMG/ETH', 'base' => 'OMG', 'quote' => 'ETH', 'baseId' => 'tOMG', 'quoteId' => 'tETH' ),
                'OMG/USD' => array ( 'id' => 'tOMGUSD', 'symbol' => 'OMG/USD', 'base' => 'OMG', 'quote' => 'USD', 'baseId' => 'tOMG', 'quoteId' => 'zUSD' ),
                'QTUM/BTC' => array ( 'id' => 'tQTMBTC', 'symbol' => 'QTUM/BTC', 'base' => 'QTUM', 'quote' => 'BTC', 'baseId' => 'tQTUM', 'quoteId' => 'tBTC' ),
                'QTUM/ETH' => array ( 'id' => 'tQTMETH', 'symbol' => 'QTUM/ETH', 'base' => 'QTUM', 'quote' => 'ETH', 'baseId' => 'tQTUM', 'quoteId' => 'tETH' ),
                'QTUM/USD' => array ( 'id' => 'tQTMUSD', 'symbol' => 'QTUM/USD', 'base' => 'QTUM', 'quote' => 'USD', 'baseId' => 'tQTUM', 'quoteId' => 'zUSD' ),
                'RRT/BTC' => array ( 'id' => 'tRRTBTC', 'symbol' => 'RRT/BTC', 'base' => 'RRT', 'quote' => 'BTC', 'baseId' => 'tRRT', 'quoteId' => 'tBTC' ),
                'RRT/USD' => array ( 'id' => 'tRRTUSD', 'symbol' => 'RRT/USD', 'base' => 'RRT', 'quote' => 'USD', 'baseId' => 'tRRT', 'quoteId' => 'zUSD' ),
                'SAN/BTC' => array ( 'id' => 'tSANBTC', 'symbol' => 'SAN/BTC', 'base' => 'SAN', 'quote' => 'BTC', 'baseId' => 'tSAN', 'quoteId' => 'tBTC' ),
                'SAN/ETH' => array ( 'id' => 'tSANETH', 'symbol' => 'SAN/ETH', 'base' => 'SAN', 'quote' => 'ETH', 'baseId' => 'tSAN', 'quoteId' => 'tETH' ),
                'SAN/USD' => array ( 'id' => 'tSANUSD', 'symbol' => 'SAN/USD', 'base' => 'SAN', 'quote' => 'USD', 'baseId' => 'tSAN', 'quoteId' => 'zUSD' ),
                'XMR/BTC' => array ( 'id' => 'tXMRBTC', 'symbol' => 'XMR/BTC', 'base' => 'XMR', 'quote' => 'BTC', 'baseId' => 'tXMR', 'quoteId' => 'tBTC' ),
                'XMR/USD' => array ( 'id' => 'tXMRUSD', 'symbol' => 'XMR/USD', 'base' => 'XMR', 'quote' => 'USD', 'baseId' => 'tXMR', 'quoteId' => 'zUSD' ),
                'XRP/BTC' => array ( 'id' => 'tXRPBTC', 'symbol' => 'XRP/BTC', 'base' => 'XRP', 'quote' => 'BTC', 'baseId' => 'tXRP', 'quoteId' => 'tBTC' ),
                'XRP/USD' => array ( 'id' => 'tXRPUSD', 'symbol' => 'XRP/USD', 'base' => 'XRP', 'quote' => 'USD', 'baseId' => 'tXRP', 'quoteId' => 'zUSD' ),
                'ZEC/BTC' => array ( 'id' => 'tZECBTC', 'symbol' => 'ZEC/BTC', 'base' => 'ZEC', 'quote' => 'BTC', 'baseId' => 'tZEC', 'quoteId' => 'tBTC' ),
                'ZEC/USD' => array ( 'id' => 'tZECUSD', 'symbol' => 'ZEC/USD', 'base' => 'ZEC', 'quote' => 'USD', 'baseId' => 'tZEC', 'quoteId' => 'zUSD' ),
                'YYW/USD' => array ( 'id' => 'tYYWUSD', 'symbol' => 'YYW/USD', 'base' => 'YYW', 'quote' => 'USD', 'baseId' => 'tYYW', 'quoteId' => 'zUSD' ),
                'YYW/BTC' => array ( 'id' => 'tYYWBTC', 'symbol' => 'YYW/BTC', 'base' => 'YYW', 'quote' => 'BTC', 'baseId' => 'tYYW', 'quoteId' => 'zBTC' ),
                'YYW/ETH' => array ( 'id' => 'tYYWETH', 'symbol' => 'YYW/ETH', 'base' => 'YYW', 'quote' => 'ETH', 'baseId' => 'tYYW', 'quoteId' => 'zETH' ),
                'SNT/USD' => array ( 'id' => 'tSNTUSD', 'symbol' => 'SNT/USD', 'base' => 'SNT', 'quote' => 'USD', 'baseId' => 'tSNT', 'quoteId' => 'zUSD' ),
                'SNT/BTC' => array ( 'id' => 'tSNTBTC', 'symbol' => 'SNT/BTC', 'base' => 'SNT', 'quote' => 'BTC', 'baseId' => 'tSNT', 'quoteId' => 'zBTC' ),
                'SNT/ETH' => array ( 'id' => 'tSNTETH', 'symbol' => 'SNT/ETH', 'base' => 'SNT', 'quote' => 'ETH', 'baseId' => 'tSNT', 'quoteId' => 'zETH' ),
                'QASH/USD' => array ( 'id' => 'tQASHUSD', 'symbol' => 'QASH/USD', 'base' => 'QASH', 'quote' => 'USD', 'baseId' => 'tQASH', 'quoteId' => 'zUSD' ),
                'QASH/BTC' => array ( 'id' => 'tQASHBTC', 'symbol' => 'QASH/BTC', 'base' => 'QASH', 'quote' => 'BTC', 'baseId' => 'tQASH', 'quoteId' => 'zBTC' ),
                'QASH/ETH' => array ( 'id' => 'tQASHETH', 'symbol' => 'QASH/ETH', 'base' => 'QASH', 'quote' => 'ETH', 'baseId' => 'tQASH', 'quoteId' => 'zETH' ),
                'GNT/USD' => array ( 'id' => 'tGNTUSD', 'symbol' => 'GNT/USD', 'base' => 'GNT', 'quote' => 'USD', 'baseId' => 'tGNT', 'quoteId' => 'zUSD' ),
                'GNT/BTC' => array ( 'id' => 'tGNTBTC', 'symbol' => 'GNT/BTC', 'base' => 'GNT', 'quote' => 'BTC', 'baseId' => 'tGNT', 'quoteId' => 'zBTC' ),
                'GNT/ETH' => array ( 'id' => 'tGNTETH', 'symbol' => 'GNT/ETH', 'base' => 'GNT', 'quote' => 'ETH', 'baseId' => 'tGNT', 'quoteId' => 'zETH' ),
                'BAT/USD' => array ( 'id' => 'tBATUSD', 'symbol' => 'BAT/USD', 'base' => 'BAT', 'quote' => 'USD', 'baseId' => 'tBAT', 'quoteId' => 'zUSD' ),
                'BAT/BTC' => array ( 'id' => 'tBATBTC', 'symbol' => 'BAT/BTC', 'base' => 'BAT', 'quote' => 'BTC', 'baseId' => 'tBAT', 'quoteId' => 'zBTC' ),
                'BAT/ETH' => array ( 'id' => 'tBATETH', 'symbol' => 'BAT/ETH', 'base' => 'BAT', 'quote' => 'ETH', 'baseId' => 'tBAT', 'quoteId' => 'zETH' ),
                'SPK/USD' => array ( 'id' => 'tSPKUSD', 'symbol' => 'SPK/USD', 'base' => 'SPK', 'quote' => 'USD', 'baseId' => 'tSPK', 'quoteId' => 'zUSD' ),
                'SPK/BTC' => array ( 'id' => 'tSPKBTC', 'symbol' => 'SPK/BTC', 'base' => 'SPK', 'quote' => 'BTC', 'baseId' => 'tSPK', 'quoteId' => 'zBTC' ),
                'SPK/ETH' => array ( 'id' => 'tSPKETH', 'symbol' => 'SPK/ETH', 'base' => 'SPK', 'quote' => 'ETH', 'baseId' => 'tSPK', 'quoteId' => 'zETH' ),
                'TRX/USD' => array ( 'id' => 'tTRXUSD', 'symbol' => 'TRX/USD', 'base' => 'TRX', 'quote' => 'USD', 'baseId' => 'tTRX', 'quoteId' => 'zUSD' ),
                'TRX/BTC' => array ( 'id' => 'tTRXBTC', 'symbol' => 'TRX/BTC', 'base' => 'TRX', 'quote' => 'BTC', 'baseId' => 'tTRX', 'quoteId' => 'zBTC' ),
                'TRX/ETH' => array ( 'id' => 'tTRXETH', 'symbol' => 'TRX/ETH', 'base' => 'TRX', 'quote' => 'ETH', 'baseId' => 'tTRX', 'quoteId' => 'zETH' ),
                'ELF/USD' => array ( 'id' => 'tELFUSD', 'symbol' => 'ELF/USD', 'base' => 'ELF', 'quote' => 'USD', 'baseId' => 'tELF', 'quoteId' => 'zUSD' ),
                'ELF/BTC' => array ( 'id' => 'tELFBTC', 'symbol' => 'ELF/BTC', 'base' => 'ELF', 'quote' => 'BTC', 'baseId' => 'tELF', 'quoteId' => 'zBTC' ),
                'ELF/ETH' => array ( 'id' => 'tELFETH', 'symbol' => 'ELF/ETH', 'base' => 'ELF', 'quote' => 'ETH', 'baseId' => 'tELF', 'quoteId' => 'zETH' ),
                'RCN/USD' => array ( 'id' => 'tRCNUSD', 'symbol' => 'RCN/USD', 'base' => 'RCN', 'quote' => 'USD', 'baseId' => 'tRCN', 'quoteId' => 'zUSD' ),
                'RCN/BTC' => array ( 'id' => 'tRCNBTC', 'symbol' => 'RCN/BTC', 'base' => 'RCN', 'quote' => 'BTC', 'baseId' => 'tRCN', 'quoteId' => 'zBTC' ),
                'RCN/ETH' => array ( 'id' => 'tRCNETH', 'symbol' => 'RCN/ETH', 'base' => 'RCN', 'quote' => 'ETH', 'baseId' => 'tRCN', 'quoteId' => 'zETH' ),
                'FUN/USD' => array ( 'id' => 'tFUNUSD', 'symbol' => 'FUN/USD', 'base' => 'FUN', 'quote' => 'USD', 'baseId' => 'tFUN', 'quoteId' => 'zUSD' ),
                'FUN/BTC' => array ( 'id' => 'tFUNBTC', 'symbol' => 'FUN/BTC', 'base' => 'FUN', 'quote' => 'BTC', 'baseId' => 'tFUN', 'quoteId' => 'zBTC' ),
                'FUN/ETH' => array ( 'id' => 'tFUNETH', 'symbol' => 'FUN/ETH', 'base' => 'FUN', 'quote' => 'ETH', 'baseId' => 'tFUN', 'quoteId' => 'zETH' ),
                'MNA/USD' => array ( 'id' => 'tMNAUSD', 'symbol' => 'MNA/USD', 'base' => 'MNA', 'quote' => 'USD', 'baseId' => 'tMNA', 'quoteId' => 'zUSD' ),
                'MNA/BTC' => array ( 'id' => 'tMNABTC', 'symbol' => 'MNA/BTC', 'base' => 'MNA', 'quote' => 'BTC', 'baseId' => 'tMNA', 'quoteId' => 'zBTC' ),
                'MNA/ETH' => array ( 'id' => 'tMNAETH', 'symbol' => 'MNA/ETH', 'base' => 'MNA', 'quote' => 'ETH', 'baseId' => 'tMNA', 'quoteId' => 'zETH' ),
                'AID/USD' => array ( 'id' => 'tAIDUSD', 'symbol' => 'AID/USD', 'base' => 'AID', 'quote' => 'USD', 'baseId' => 'tAID', 'quoteId' => 'zUSD' ),
                'AID/BTC' => array ( 'id' => 'tAIDBTC', 'symbol' => 'AID/BTC', 'base' => 'AID', 'quote' => 'BTC', 'baseId' => 'tAID', 'quoteId' => 'zBTC' ),
                'AID/ETH' => array ( 'id' => 'tAIDETH', 'symbol' => 'AID/ETH', 'base' => 'AID', 'quote' => 'ETH', 'baseId' => 'tAID', 'quoteId' => 'zETH' ),
                'REP/USD' => array ( 'id' => 'tREPUSD', 'symbol' => 'REP/USD', 'base' => 'REP', 'quote' => 'USD', 'baseId' => 'tREP', 'quoteId' => 'zUSD' ),
                'REP/BTC' => array ( 'id' => 'tREPBTC', 'symbol' => 'REP/BTC', 'base' => 'REP', 'quote' => 'BTC', 'baseId' => 'tREP', 'quoteId' => 'zBTC' ),
                'REP/ETH' => array ( 'id' => 'tREPETH', 'symbol' => 'REP/ETH', 'base' => 'REP', 'quote' => 'ETH', 'baseId' => 'tREP', 'quoteId' => 'zETH' ),
                'SNG/USD' => array ( 'id' => 'tSNGUSD', 'symbol' => 'SNG/USD', 'base' => 'SNG', 'quote' => 'USD', 'baseId' => 'tSNG', 'quoteId' => 'zUSD' ),
                'SNG/BTC' => array ( 'id' => 'tSNGBTC', 'symbol' => 'SNG/BTC', 'base' => 'SNG', 'quote' => 'BTC', 'baseId' => 'tSNG', 'quoteId' => 'zBTC' ),
                'SNG/ETH' => array ( 'id' => 'tSNGETH', 'symbol' => 'SNG/ETH', 'base' => 'SNG', 'quote' => 'ETH', 'baseId' => 'tSNG', 'quoteId' => 'zETH' ),
                'RLC/USD' => array ( 'id' => 'tRLCUSD', 'symbol' => 'RLC/USD', 'base' => 'RLC', 'quote' => 'USD', 'baseId' => 'tRLC', 'quoteId' => 'zUSD' ),
                'RLC/BTC' => array ( 'id' => 'tRLCBTC', 'symbol' => 'RLC/BTC', 'base' => 'RLC', 'quote' => 'BTC', 'baseId' => 'tRLC', 'quoteId' => 'zBTC' ),
                'RLC/ETH' => array ( 'id' => 'tRLCETH', 'symbol' => 'RLC/ETH', 'base' => 'RLC', 'quote' => 'ETH', 'baseId' => 'tRLC', 'quoteId' => 'zETH' ),
                'TNB/USD' => array ( 'id' => 'tTNBUSD', 'symbol' => 'TNB/USD', 'base' => 'TNB', 'quote' => 'USD', 'baseId' => 'tTNB', 'quoteId' => 'zUSD' ),
                'TNB/BTC' => array ( 'id' => 'tTNBBTC', 'symbol' => 'TNB/BTC', 'base' => 'TNB', 'quote' => 'BTC', 'baseId' => 'tTNB', 'quoteId' => 'zBTC' ),
                'TNB/ETH' => array ( 'id' => 'tTNBETH', 'symbol' => 'TNB/ETH', 'base' => 'TNB', 'quote' => 'ETH', 'baseId' => 'tTNB', 'quoteId' => 'zETH' ),
                'ZRX/USD' => array ( 'id' => 'tZRXUSD', 'symbol' => 'ZRX/USD', 'base' => 'ZRX', 'quote' => 'USD', 'baseId' => 'tZRX', 'quoteId' => 'zUSD' ),
                'ZRX/BTC' => array ( 'id' => 'tZRXBTC', 'symbol' => 'ZRX/BTC', 'base' => 'ZRX', 'quote' => 'BTC', 'baseId' => 'tZRX', 'quoteId' => 'zBTC' ),
                'ZRX/ETH' => array ( 'id' => 'tZRXETH', 'symbol' => 'ZRX/ETH', 'base' => 'ZRX', 'quote' => 'ETH', 'baseId' => 'tZRX', 'quoteId' => 'zETH' ),
            ),
            'fees' => array (
                'trading' => array (
                    'maker' => 0.1 / 100,
                    'taker' => 0.2 / 100,
                ),
                'funding' => array (
                    'withdraw' => array (
                        'BTC' => 0.0005,
                        'BCH' => 0.0005,
                        'ETH' => 0.01,
                        'EOS' => 0.1,
                        'LTC' => 0.001,
                        'OMG' => 0.1,
                        'IOT' => 0.0,
                        'NEO' => 0.0,
                        'ETC' => 0.01,
                        'XRP' => 0.02,
                        'ETP' => 0.01,
                        'ZEC' => 0.001,
                        'BTG' => 0.0,
                        'DASH' => 0.01,
                        'XMR' => 0.04,
                        'QTM' => 0.01,
                        'EDO' => 0.5,
                        'DAT' => 1.0,
                        'AVT' => 0.5,
                        'SAN' => 0.1,
                        'USDT' => 5.0,
                        'SPK' => 9.2784,
                        'BAT' => 9.0883,
                        'GNT' => 8.2881,
                        'SNT' => 14.303,
                        'QASH' => 3.2428,
                        'YYW' => 18.055,
                    ),
                ),
            ),
        ));
    }

    public function common_currency_code ($currency) {
        $currencies = array (
            'DSH' => 'DASH', // Bitfinex names Dash as DSH, instead of DASH
            'QTM' => 'QTUM',
            'BCC' => 'CST_BCC',
            'BCU' => 'CST_BCU',
            'IOT' => 'IOTA',
            'DAT' => 'DATA',
        );
        return (is_array ($currencies) && array_key_exists ($currency, $currencies)) ? $currencies[$currency] : $currency;
    }

    public function fetch_balance ($params = array ()) {
        $response = $this->privatePostAuthRWallets ();
        $balanceType = $this->safe_string($params, 'type', 'exchange');
        $result = array ( 'info' => $response );
        for ($b = 0; $b < count ($response); $b++) {
            $balance = $response[$b];
            $accountType = $balance[0];
            $currency = $balance[1];
            $total = $balance[2];
            $available = $balance[4];
            if ($accountType === $balanceType) {
                if ($currency[0] === 't')
                    $currency = mb_substr ($currency, 1);
                $uppercase = strtoupper ($currency);
                $uppercase = $this->common_currency_code($uppercase);
                $account = $this->account ();
                $account['free'] = $available;
                $account['total'] = $total;
                if ($account['free'])
                    $account['used'] = $account['total'] - $account['free'];
                $result[$uppercase] = $account;
            }
        }
        return $this->parse_balance($result);
    }

    public function fetch_order_book ($symbol, $limit = null, $params = array ()) {
        $orderbook = $this->publicGetBookSymbolPrecision (array_merge (array (
            'symbol' => $this->market_id($symbol),
            'precision' => 'R0',
        ), $params));
        $timestamp = $this->milliseconds ();
        $result = array (
            'bids' => array (),
            'asks' => array (),
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
        );
        for ($i = 0; $i < count ($orderbook); $i++) {
            $order = $orderbook[$i];
            $price = $order[1];
            $amount = $order[2];
            $side = ($amount > 0) ? 'bids' : 'asks';
            $amount = abs ($amount);
            $result[$side][] = array ( $price, $amount );
        }
        $result['bids'] = $this->sort_by($result['bids'], 0, true);
        $result['asks'] = $this->sort_by($result['asks'], 0);
        return $result;
    }

    public function parse_ticker ($ticker, $market = null) {
        $timestamp = $this->milliseconds ();
        $symbol = null;
        if ($market)
            $symbol = $market['symbol'];
        $length = is_array ($ticker) ? count ($ticker) : 0;
        return array (
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
            'high' => $ticker[$length - 2],
            'low' => $ticker[$length - 1],
            'bid' => $ticker[$length - 10],
            'ask' => $ticker[$length - 8],
            'vwap' => null,
            'open' => null,
            'close' => null,
            'first' => null,
            'last' => $ticker[$length - 4],
            'change' => $ticker[$length - 6],
            'percentage' => $ticker[$length - 5],
            'average' => null,
            'baseVolume' => $ticker[$length - 3],
            'quoteVolume' => null,
            'info' => $ticker,
        );
    }

    public function fetch_tickers ($symbols = null, $params = array ()) {
        $tickers = $this->publicGetTickers (array_merge (array (
            'symbols' => implode (',', $this->ids),
        ), $params));
        $result = array ();
        for ($i = 0; $i < count ($tickers); $i++) {
            $ticker = $tickers[$i];
            $id = $ticker[0];
            $market = $this->markets_by_id[$id];
            $symbol = $market['symbol'];
            $result[$symbol] = $this->parse_ticker($ticker, $market);
        }
        return $result;
    }

    public function fetch_ticker ($symbol, $params = array ()) {
        $market = $this->markets[$symbol];
        $ticker = $this->publicGetTickerSymbol (array_merge (array (
            'symbol' => $market['id'],
        ), $params));
        return $this->parse_ticker($ticker, $market);
    }

    public function parse_trade ($trade, $market) {
        list ($id, $timestamp, $amount, $price) = $trade;
        $side = ($amount < 0) ? 'sell' : 'buy';
        if ($amount < 0) {
            $amount = -$amount;
        }
        return array (
            'id' => (string) $id,
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601 ($timestamp),
            'symbol' => $market['symbol'],
            'type' => null,
            'side' => $side,
            'price' => $price,
            'amount' => $amount,
        );
    }

    public function fetch_trades ($symbol, $since = null, $limit = null, $params = array ()) {
        $market = $this->market ($symbol);
        $request = array (
            'symbol' => $market['id'],
        );
        if ($since !== null)
            $request['start'] = $since;
        if ($limit !== null)
            $request['limit'] = $limit;
        $response = $this->publicGetTradesSymbolHist (array_merge ($request, $params));
        return $this->parse_trades($response, $market, $since, $limit);
    }

    public function fetch_ohlcv ($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        $market = $this->market ($symbol);
        $request = array (
            'symbol' => $market['id'],
            'timeframe' => $this->timeframes[$timeframe],
            'sort' => 1,
        );
        if ($limit !== null)
            $request['limit'] = $limit;
        if ($since !== null)
            $request['start'] = $since;
        $request = array_merge ($request, $params);
        $response = $this->publicGetCandlesTradeTimeframeSymbolHist ($request);
        return $this->parse_ohlcvs($response, $market, $timeframe, $since, $limit);
    }

    public function create_order ($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        throw new NotSupported ($this->id . ' createOrder not implemented yet');
    }

    public function cancel_order ($id, $symbol = null, $params = array ()) {
        throw new NotSupported ($this->id . ' cancelOrder not implemented yet');
    }

    public function fetch_order ($id, $symbol = null, $params = array ()) {
        throw new NotSupported ($this->id . ' fetchOrder not implemented yet');
    }

    public function withdraw ($currency, $amount, $address, $tag = null, $params = array ()) {
        throw new NotSupported ($this->id . ' withdraw not implemented yet');
    }

    public function nonce () {
        return $this->milliseconds ();
    }

    public function sign ($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $request = $this->version . '/' . $this->implode_params($path, $params);
        $query = $this->omit ($params, $this->extract_params($path));
        $url = $this->urls['api'] . '/' . $request;
        if ($api === 'public') {
            if ($query) {
                $url .= '?' . $this->urlencode ($query);
            }
        } else {
            $this->check_required_credentials();
            $nonce = (string) $this->nonce ();
            $body = $this->json ($query);
            $auth = '/api' . '/' . $request . $nonce . $body;
            $signature = $this->hmac ($this->encode ($auth), $this->encode ($this->secret), 'sha384');
            $headers = array (
                'bfx-nonce' => $nonce,
                'bfx-apikey' => $this->apiKey,
                'bfx-signature' => $signature,
                'Content-Type' => 'application/json',
            );
        }
        return array ( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function request ($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $response = $this->fetch2 ($path, $api, $method, $params, $headers, $body);
        if ($response) {
            if (is_array ($response) && array_key_exists ('message', $response)) {
                if (mb_strpos ($response['message'], 'not enough exchange balance') !== false)
                    throw new InsufficientFunds ($this->id . ' ' . $this->json ($response));
                throw new ExchangeError ($this->id . ' ' . $this->json ($response));
            }
            return $response;
        } else if ($response === '') {
            throw new ExchangeError ($this->id . ' returned empty response');
        }
        return $response;
    }
}

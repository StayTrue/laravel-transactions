<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class CurrencyHelper
{
    /**
     * Redis storage key
     *
     * @var string
     */
    public const CURRENCY_REDIS_KEY = 'currencies:';

    /**
     * Url for getting rate data
     */
    public const RATE_CHECK_URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * Get currency rate
     *
     * @param string $currency Currency
     * @param string $date     Date
     *
     * @return float
     */
    public static function getCurrencyRate(string $currency, string $date)
    {
        if ($currency === 'RUB')
        {
            return 1;
        }

        $date = Carbon::createFromDate($date);
        $redisKey = self::getCurrencyRateKey($currency, $date->format('Ymd'));
        if (Redis::exists($redisKey) === 0)
        {
            $xmlData = new \SimpleXMLElement(self::RATE_CHECK_URL . '?date_req=' . $date->format('d/m/Y'), 0, true);
            foreach ($xmlData as $xmlElement)
            {
                if ((string) $xmlElement->CharCode === $currency)
                {
                    $value = (float) str_replace( ',', '.', $xmlElement->Value);
                    Redis::set($redisKey, $value);
                    return $value;
                }
            }
        }

        $value = Redis::get($redisKey);
        return (float) $value;
    }

    /**
     * Get currency rate redis key
     *
     * @param string $currency Currency
     * @param string $date     Date
     *
     * @return string
     */
    public static function getCurrencyRateKey(string $currency, string $date)
    {
        return self::CURRENCY_REDIS_KEY . $currency . ':' . $date;
    }
}

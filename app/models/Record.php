<?php

class Record extends Eloquent
{
    public $timestamps = false;

    public $guarded = ['changed_date', 'disabled', 'ordername', 'auth'];

    private static $createRules = [
        'domain_id' => 'required|exists:domains,id',
        'name'  => 'required',
        'type' => 'required',
        'content' => 'required',
        'ttl' => 'required|integer',
        'prio' => 'required|integer',
    ];

    public static function getCreateRules()
    {
        $createRules = self::$createRules;
        $createRules['type'] .= '|in:'.implode(',', Record::$types);

        return $createRules;
    }

    public static $types = [
        'A',
        'AAAA',
        'AFSDB',
        'CERT',
        'CNAME',
        'DHCID',
        'DLV',
        'DNSKEY',
        'DS',
        'EUI48',
        'EUI64',
        'HINFO',
        'IPSECKEY',
        'KEY',
        'KX',
        'LOC',
        'MINFO',
        'MR',
        'MX',
        'NAPTR',
        'NS',
        'NSEC',
        'NSEC3',
        'NSEC3PARAM',
        'OPT',
        'PTR',
        'RKEY',
        'RP',
        'RRSIG',
        'SOA',
        'SPF',
        'SRV',
        'SSHFP',
        'TLSA',
        'TSIG',
        'TXT',
        'WKS',
    ];
}

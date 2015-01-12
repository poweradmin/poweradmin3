<?php

class Record extends Eloquent
{
    public $timestamps = false;

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

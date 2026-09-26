<?php
namespace Exbil\Mailcow\Fail2Ban;

use Exbil\MailCowAPI;

class Fail2Ban {
    private $MailCowAPI;

    public function __construct(MailCowAPI $MailCowAPI){
        $this->MailCowAPI = $MailCowAPI;
    }

    /**
     * editConfig - Edit Fail2Ban config
     * @param int $bantimeInMs Time in ms the IP gets banned
     * @param int $banTimeIncrement Increment for ban time
     * @param string $blacklist Blacklist of IPs, e.g. "10.10.10.0/24, 10.100.8.4/32"
     * @param int $max_attempts Maximum amount of failed login attempts before banning the IP
     * @param int $netban_ipv4 Netmask for IPv4 addresses, e.g, 24 for /24
     * @param int $netban_ipv6 Netmask for IPv6 addresses, e.g, 64 for /64
     * @param int $retry_window Time in seconds for the retry window, e.g. 600
     * @param string $whitelist A whitelist, e.g. "mydomain.com, anotherdomain.org"
     * @return array
     */
    public function editConfig(int $bantimeInMs, int $banTimeIncrement, string $blacklist, int $max_attempts = 5, int $netban_ipv4 = 24, int $netban_ipv6 = 64, int $retry_window = 600, string $whitelist = null){
        return $this->MailCowAPI->post('edit/fail2ban', [
            "attr"=> [
                "ban_time" => $bantimeInMs,
                "ban_time_increment" => $banTimeIncrement,
                "blacklist" => $blacklist,
                "max_attempts" => $max_attempts,
                "netban_ipv4" => $netban_ipv4,
                "netban_ipv6" => $netban_ipv6,
                "retry_window" => $retry_window,
                "whitelist" => $whitelist
            ],
            "items" => "none"
        ]);
    }

    /**
     * `getConfig()` - Returns the fail2ban configuration
     * @return array
     */
    public function getConfig(){
        return $this->MailCowAPI->get('get/fail2ban');
    }
}
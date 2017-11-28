<?php
/**
 * Cracks given MD5 hash
 */
$hash = $argv[1];

// world list, eg. https://wiki.skullsecurity.org/Passwords
$wordlist = '/usr/share/wordlists/rockyou.txt';

// hashcat, see https://hashcat.net/hashcat
$command = "hashcat -m 0 --potfile-disable $hash $wordlist" . PHP_EOL;

echo $command;

passthru($command);

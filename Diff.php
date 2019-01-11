<?php
namespace kjBotModule\kj415j45\Arcaea;

class Diff{
    const PST = 0;
    const PSR = 1;
    const FTR = 2;
    public static function ToText(int $diff): string{
        switch($diff){
            case Diff::FTR:
                return 'FTR';
            case Diff::PSR:
                return 'PSR';
            case Diff::PST:
                return 'PST';
            default: return NULL;
        }
    }
}
<?php
  
namespace App\Enums;
 
enum UserTypeEnum:int {
    case CUSTOMER = 10;
    case NORMAL_ADMIN = 20;
    case SUPER_ADMIN = 30;

    public static function getEnumValue($value) {
        switch ($value) {
            case self::CUSTOMER:
                return 'CUSTOMER';
            case self::NORMAL_ADMIN:
                return 'NORMAL_ADMIN';
            case self::SUPER_ADMIN:
                return 'SUPER_ADMIN';
            default:
                return null; // Or handle the case for an unknown value
        }
    }
}
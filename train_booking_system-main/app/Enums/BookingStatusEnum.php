<?php
  
namespace App\Enums;
 
enum BookingStatusEnum:string {
    case PENDING = "pending";
    case COMPLETE = "complete";
    case CANCELLED = "cancelled";
}
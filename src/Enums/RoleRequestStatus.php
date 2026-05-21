<?php
namespace DevSphere\Enums;

enum RoleRequestStatus : string {
    case PENDING = 'Pending';
    case ACCEPTED = 'Accepted';
    case DECLINED = 'Declined';
} 
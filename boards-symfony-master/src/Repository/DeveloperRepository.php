<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Developer;

class DeveloperRepository extends MainRepository{
    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Developer::class);
    }
}

<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Task;

class TaskRepository extends MainRepository{
    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Task::class);
    }
}
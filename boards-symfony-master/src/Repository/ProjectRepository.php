<?php

namespace App\Repository;

use App\Entity\Project;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProjectRepository extends MainRepository{
    public function __construct(RegistryInterface $registry){
        parent::__construct($registry, Project::class);
    }
}

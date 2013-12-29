<?php
/**
 * Created by PhpStorm.
 * User: Lucups
 * Date: 13-12-27
 * Time: 上午12:34
 */

namespace Caiwen\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class QuestionRepository {

    public function save($question) {
        $this->getEntityManager()->persist($question);
        $this->getEntityManager()->flush();
        return $question->getNewsId();
    }

    public function delete($question) {
        $this->getEntityManager()->remove($question);
        $this->getEntityManager()->flush();
    }

} 
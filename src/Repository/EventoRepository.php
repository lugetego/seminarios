<?php

namespace App\Repository;

use App\Entity\Evento;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evento[]    findAll()
 * @method Evento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    // /**
    //  * @return Evento[] Returns an array of Evento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findAllbyYear($year)
    {
        $beginDate = new DateTimeImmutable($year.'-01-01');
        $endDate = new DateTimeImmutable($year.'-12-31');

        return $this->createQueryBuilder('e')
            ->andWhere('e.fecha > :beginDate')
            ->setParameter('beginDate', $beginDate)
            ->andWhere('e.fecha < :endDate')
            ->setParameter('endDate', $endDate)
            ->orderBy('e.fecha', 'DESC')
            ->getQuery()
            ->getResult()
            ;





        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM Evento e ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        return $consulta->getResult();
    }

   /* public function findEventosAnteriores($seminario)
    {
        $fechaHoy= new \DateTime('today');
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.seminario = :seminario AND e.fecha < :fecha ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('fecha'=>$fechaHoy ,'seminario'=>$seminario));
        return $consulta->getResult();
    }

    public function findEventos($seminario)
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.seminario = :seminario ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('seminario'=>$seminario));
        return $consulta->getResult();
    }

    public function findEventosSemana()
    {
        $lunes= date('Y/m/d',strtotime('Monday this week'));
        $viernes= date('Y/m/d',strtotime('Friday this week'));
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fecha ASC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }

    public function findEventosSemanaSig()
    {
        $fecha= date("W")+1;
        //$lunes= date('Y/m/d',strtotime(date("Y")."W".$fecha."1"));
        //$viernes= date('Y/m/d',strtotime(date("Y")."W".$fecha."5"));
        $lunes= date('Y/m/d',strtotime('Monday next week'));
        $viernes= date('Y/m/d',strtotime('Friday next week'));
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }
    public function findEventosToCalendar()
    {
        $fecha= date("W");
        $lunes= date('Y/m/d',strtotime(date("Y")."W".$fecha."1"));

        $fecha2= date("W")+1;
        $viernes= date('Y/m/d',strtotime(date("Y")."W".$fecha2."5"));

        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        //$consulta->setParameter('fecha',$fechaHoy);
        //$consulta-> setParameter('seminario',$seminario);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }

    public function findEventosToCalendarAll()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);

        return $consulta->getResult();
    }

    public function findEventosProx()
    {
        $hoy = date('Y/m/d');

        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha > :hoy ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('hoy'=>$hoy));

        return $consulta->getResult();
    }

    public function findColoquioSemana()
    {
        $lunes= date('Y/m/d',strtotime('Monday this week'));
        $viernes= date('Y/m/d',strtotime('Friday this week'));
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes AND e.nombre LIKE :nombre ORDER BY e.fecha DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));

        return $consulta->getResult();
    }*/


    /*
    public function findOneBySomeField($value): ?Evento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

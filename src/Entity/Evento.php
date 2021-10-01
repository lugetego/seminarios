<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventoRepository::class)
 */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lugar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsables;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="time")
     */
    private $hora;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ponente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $platica;

    /**
     * @ORM\Column(type="text")
     */
    private $resumen;

    /**
     * @ORM\Column(type="text")
     */
    private $comentario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLugar(): ?string
    {
        return $this->lugar;
    }

    public function setLugar(string $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getResponsables(): ?string
    {
        return $this->responsables;
    }

    public function setResponsables(string $responsables): self
    {
        $this->responsables = $responsables;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function getPonente(): ?string
    {
        return $this->ponente;
    }

    public function setPonente(string $ponente): self
    {
        $this->ponente = $ponente;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(string $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getPlatica(): ?string
    {
        return $this->platica;
    }

    public function setPlatica(string $platica): self
    {
        $this->platica = $platica;

        return $this;
    }

    public function getResumen(): ?string
    {
        return $this->resumen;
    }

    public function setResumen(string $resumen): self
    {
        $this->resumen = $resumen;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }
}

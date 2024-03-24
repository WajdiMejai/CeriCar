<?php
use Doctorine\Common\Collections\ArrayCollection;
/** 
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage
{
/** @Id @Column(type="integer")
 * @GeneratedValue
 */
public $id;
/**
 * @ManyToOne(targetEntity="utilisateur")
 * @JoinColumn(name="conducteur",referencedColumnName="id")
 */
public $conducteur;
/**
 * @ManyToOne(targetEntity="trajet")
 * @JoinColumn(name="trajet",referencedColumnName="id")
 */
public $trajet;
/** @column(type="integer") */
public $tarif;
/** @column(type="integer") */
public $nbplace;
/** @column(type="integer") */
public $heuredepart;
/** @Column(type="string", length=500) */
public $contraintes;
}
?>
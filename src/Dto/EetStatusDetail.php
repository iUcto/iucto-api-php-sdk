<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for EetStatusDetail data
 *
 * @author iucto.cz
 */
class EetStatusDetail extends EetStatusOverview
{
    /** @var string */
    protected $datOdesl;

    /** @var bool */
    protected $prvniZaslani;

    /** @var bool */
    protected $overeni;

    /** @var string */
    protected $dicPopl;

    /** @var string */
    protected $dicPoverujiciho;

    /** @var int */
    protected $idProvoz;

    /** @var string */
    protected $idPokl;

    /** @var string */
    protected $poradCis;

    /** @var string */
    protected $datTrzby;

    /** @var float */
    protected $celkTrzba;

    /** @var float */
    protected $zaklNepodlDph;

    /** @var float */
    protected $zaklDan1;

    /** @var float */
    protected $dan1;

    /** @var float */
    protected $zaklDan2;

    /** @var float */
    protected $dan2;

    /** @var float */
    protected $zaklDan3;

    /** @var float */
    protected $dan3;

    /** @var float */
    protected $cestSluz;

    /** @var float */
    protected $pouzitZboz1;

    /** @var float */
    protected $pouzitZboz2;

    /** @var float */
    protected $pouzitZboz3;

    /** @var float */
    protected $urcenoCerpZuct;

    /** @var float */
    protected $cerpZuct;

    /** @var int(1) */
    protected $rezim;

    /** @var string */
    protected $datPrij;

    /** @var string */
    protected $test;

    /** @var string */
    protected $kodVarov;

    /** @var string */
    protected $varovani;


    /**
     * @param mixed[] $arrayData input data
     */
    public function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) return;

        parent::__construct($arrayData);

        $this->datOdesl = Utils::getValueOrNull($arrayData, 'dat_odesl');
        $this->prvniZaslani = Utils::getValueOrNull($arrayData, 'prvni_zaslani');
        $this->overeni = Utils::getValueOrNull($arrayData, 'overeni');
        $this->dicPopl = Utils::getValueOrNull($arrayData, 'dic_popl');
        $this->dicPoverujiciho = Utils::getValueOrNull($arrayData, 'dic_poverujiciho');
        $this->idProvoz = Utils::getValueOrNull($arrayData, 'id_provoz');
        $this->idPokl = Utils::getValueOrNull($arrayData, 'id_pokl');
        $this->poradCis = Utils::getValueOrNull($arrayData, 'porad_cis');
        $this->datTrzby = Utils::getValueOrNull($arrayData, 'dat_trzby');
        $this->celkTrzba = Utils::getValueOrNull($arrayData, 'celk_trzba');
        $this->zaklNepodlDph = Utils::getValueOrNull($arrayData, 'zakl_nepodl_dph');
        $this->zaklDan1 = Utils::getValueOrNull($arrayData, 'zakl_dan1');
        $this->dan1 = Utils::getValueOrNull($arrayData, 'dan1');
        $this->zaklDan2 = Utils::getValueOrNull($arrayData, 'zakl_dan2');
        $this->dan2 = Utils::getValueOrNull($arrayData, 'dan2');
        $this->zaklDan3 = Utils::getValueOrNull($arrayData, 'zakl_dan3');
        $this->dan3 = Utils::getValueOrNull($arrayData, 'dan3');
        $this->cestSluz = Utils::getValueOrNull($arrayData, 'cest_sluz');
        $this->pouzitZboz1 = Utils::getValueOrNull($arrayData, 'pouzit_zbozi1');
        $this->pouzitZboz2 = Utils::getValueOrNull($arrayData, 'pouzit_zbozi2');
        $this->pouzitZboz3 = Utils::getValueOrNull($arrayData, 'pouzit_zbozi3');
        $this->urcenoCerpZuct = Utils::getValueOrNull($arrayData, 'urceno_cerp_zuct');
        $this->cerpZuct = Utils::getValueOrNull($arrayData, 'cerp_zuct');
        $this->rezim = Utils::getValueOrNull($arrayData, 'rezim');
        $this->datPrij = Utils::getValueOrNull($arrayData, 'dat_prij');
        $this->test = Utils::getValueOrNull($arrayData, 'test');
        $this->kodVarov = Utils::getValueOrNull($arrayData, 'kod_varov');
        $this->varovani = Utils::getValueOrNull($arrayData, 'Varovani');
    }

    /**
     * @return string
     */
    public function getDatOdesl()
    {
        return $this->datOdesl;
    }

    /**
     * @return bool
     */
    public function isPrvniZaslani()
    {
        return $this->prvniZaslani;
    }

    /**
     * @return bool
     */
    public function isOvereni()
    {
        return $this->overeni;
    }

    /**
     * @return string
     */
    public function getDicPopl()
    {
        return $this->dicPopl;
    }

    /**
     * @return string
     */
    public function getDicPoverujiciho()
    {
        return $this->dicPoverujiciho;
    }

    /**
     * @return int
     */
    public function getIdProvoz()
    {
        return $this->idProvoz;
    }

    /**
     * @return string
     */
    public function getIdPokl()
    {
        return $this->idPokl;
    }

    /**
     * @return string
     */
    public function getPoradCis()
    {
        return $this->poradCis;
    }

    /**
     * @return string
     */
    public function getDatTrzby()
    {
        return $this->datTrzby;
    }

    /**
     * @return float
     */
    public function getCelkTrzba()
    {
        return $this->celkTrzba;
    }

    /**
     * @return float
     */
    public function getZaklNepodlDph()
    {
        return $this->zaklNepodlDph;
    }

    /**
     * @return float
     */
    public function getZaklDan1()
    {
        return $this->zaklDan1;
    }

    /**
     * @return float
     */
    public function getDan1()
    {
        return $this->dan1;
    }

    /**
     * @return float
     */
    public function getZaklDan2()
    {
        return $this->zaklDan2;
    }

    /**
     * @return float
     */
    public function getDan2()
    {
        return $this->dan2;
    }

    /**
     * @return float
     */
    public function getZaklDan3()
    {
        return $this->zaklDan3;
    }

    /**
     * @return float
     */
    public function getDan3()
    {
        return $this->dan3;
    }

    /**
     * @return float
     */
    public function getCestSluz()
    {
        return $this->cestSluz;
    }

    /**
     * @return float
     */
    public function getPouzitZboz1()
    {
        return $this->pouzitZboz1;
    }

    /**
     * @return float
     */
    public function getPouzitZboz2()
    {
        return $this->pouzitZboz2;
    }

    /**
     * @return float
     */
    public function getPouzitZboz3()
    {
        return $this->pouzitZboz3;
    }

    /**
     * @return float
     */
    public function getUrcenoCerpZuct()
    {
        return $this->urcenoCerpZuct;
    }

    /**
     * @return float
     */
    public function getCerpZuct()
    {
        return $this->cerpZuct;
    }

    /**
     * @return int
     */
    public function getRezim()
    {
        return $this->rezim;
    }

    /**
     * @return string
     */
    public function getDatPrij()
    {
        return $this->datPrij;
    }

    /**
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @return string
     */
    public function getKodVarov()
    {
        return $this->kodVarov;
    }

    /**
     * @return string
     */
    public function getVarovani()
    {
        return $this->varovani;
    }


}

<?php

namespace IUcto\Command;

/**
 * Description of SaveEetStatus
 *
 * @author iucto.cz
 */
class SaveEetStatus
{
    /** @var string */
    protected $uuidZpravy;

    /** @var string */
    protected $pkp;

    /** @var string */
    protected $bkp;

    /** @var string */
    protected $fik;

    /** @var string */
    protected $status;

    /** @var bool */
    protected $external;

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


    function __construct(array $arrayData = [])
    {
        if (empty($arrayData)) {
            return;
        }

        $this->uuidZpravy = $arrayData['uuid_zpravy'];
        $this->pkp = $arrayData['pkp'];
        $this->bkp = $arrayData['bkp'];
        $this->fik = $arrayData['fik'];
        $this->status = $arrayData['status'];
        $this->external = $arrayData['external'];
        $this->datOdesl = $arrayData['dat_odesl'];
        $this->prvniZaslani = $arrayData['prvni_zaslani'];
        $this->overeni = $arrayData['overeni'];
        $this->dicPopl = $arrayData['dic_popl'];
        $this->dicPoverujiciho = $arrayData['dic_poverujiciho'];
        $this->idProvoz = $arrayData['id_provoz'];
        $this->idPokl = $arrayData['id_pokl'];
        $this->poradCis = $arrayData['porad_cis'];
        $this->datTrzby = $arrayData['dat_trzby'];
        $this->celkTrzba = $arrayData['celk_trzba'];
        $this->zaklNepodlDph = $arrayData['zakl_nepodl_dph'];
        $this->zaklDan1 = $arrayData['zakl_dan1'];
        $this->dan1 = $arrayData['dan1'];
        $this->zaklDan2 = $arrayData['zakl_dan2'];
        $this->dan2 = $arrayData['dan2'];
        $this->zaklDan3 = $arrayData['zakl_dan3'];
        $this->dan3 = $arrayData['dan3'];
        $this->cestSluz = $arrayData['cest_sluz'];
        $this->pouzitZboz1 = $arrayData['pouzit_zbozi1'];
        $this->pouzitZboz2 = $arrayData['pouzit_zbozi2'];
        $this->pouzitZboz3 = $arrayData['pouzit_zbozi3'];
        $this->urcenoCerpZuct = $arrayData['urceno_cerp_zuct'];
        $this->cerpZuct = $arrayData['cerp_zuct'];
        $this->rezim = $arrayData['rezim'];
        $this->datPrij = $arrayData['dat_prij'];
        $this->test = $arrayData['test'];
        $this->kodVarov = $arrayData['kod_varov'];
        $this->varovani = $arrayData['Varovani'];
    }


    public function toArray()
    {
        return [
            'uuid_zpravy' => $this->uuidZpravy,
            'pkp' => $this->pkp,
             'bkp' => $this->bkp,
            'fik' => $this->fik,
            'status' => $this->status,
            'external' => $this->external,
            'dat_odesl' => $this->datOdesl,
            'prvni_zaslani' => $this->prvniZaslani,
            'overeni' => $this->overeni,
            'dic_popl' => $this->dicPopl,
            'dic_poverujiciho' => $this->dicPoverujiciho,
            'id_provoz' => $this->idProvoz,
            'id_pokl' => $this->idPokl,
            'porad_cis' => $this->poradCis,
            'dat_trzby' => $this->datTrzby,
            'celk_trzba' => $this->celkTrzba,
            'zakl_nepodl_dph' => $this->zaklNepodlDph,
            'zakl_dan1' => $this->zaklDan1,
            'dan1' => $this->dan1,
            'zakl_dan2' => $this->zaklDan2,
            'dan2' => $this->dan2,
            'zakl_dan3' => $this->zaklDan3,
            'dan3' => $this->dan3,
            'cest_sluz' => $this->cestSluz,
            'pouzit_zbozi1' => $this->pouzitZboz1,
            'pouzit_zbozi2' => $this->pouzitZboz2,
            'pouzit_zbozi3' => $this->pouzitZboz3,
            'urceno_cerp_zuct' => $this->urcenoCerpZuct,
            'cerp_zuct' => $this->cerpZuct,
            'rezim' => $this->rezim,
            'dat_prij' => $this->datPrij,
            'test' => $this->test,
            'kod_varov' => $this->kodVarov,
            'Varovani' => $this->varovani,
        ];
    }

    /**
     * @return string
     */
    public function getUuidZpravy()
    {
        return $this->uuidZpravy;
    }

    /**
     * @param string $uuidZpravy
     */
    public function setUuidZpravy($uuidZpravy)
    {
        $this->uuidZpravy = $uuidZpravy;
    }

    /**
     * @return string
     */
    public function getPkp()
    {
        return $this->pkp;
    }

    /**
     * @param string $pkp
     */
    public function setPkp($pkp)
    {
        $this->pkp = $pkp;
    }

    /**
     * @return string
     */
    public function getBkp()
    {
        return $this->bkp;
    }

    /**
     * @param string $bkp
     */
    public function setBkp($bkp)
    {
        $this->bkp = $bkp;
    }

    /**
     * @return string
     */
    public function getFik()
    {
        return $this->fik;
    }

    /**
     * @param string $fik
     */
    public function setFik($fik)
    {
        $this->fik = $fik;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isExternal()
    {
        return $this->external;
    }

    /**
     * @param bool $external
     */
    public function setExternal($external)
    {
        $this->external = $external;
    }

    /**
     * @return string
     */
    public function getDatOdesl()
    {
        return $this->datOdesl;
    }

    /**
     * @param string $datOdesl
     */
    public function setDatOdesl($datOdesl)
    {
        $this->datOdesl = $datOdesl;
    }

    /**
     * @return bool
     */
    public function isPrvniZaslani()
    {
        return $this->prvniZaslani;
    }

    /**
     * @param bool $prvniZaslani
     */
    public function setPrvniZaslani($prvniZaslani)
    {
        $this->prvniZaslani = $prvniZaslani;
    }

    /**
     * @return bool
     */
    public function isOvereni()
    {
        return $this->overeni;
    }

    /**
     * @param bool $overeni
     */
    public function setOvereni($overeni)
    {
        $this->overeni = $overeni;
    }

    /**
     * @return string
     */
    public function getDicPopl()
    {
        return $this->dicPopl;
    }

    /**
     * @param string $dicPopl
     */
    public function setDicPopl($dicPopl)
    {
        $this->dicPopl = $dicPopl;
    }

    /**
     * @return string
     */
    public function getDicPoverujiciho()
    {
        return $this->dicPoverujiciho;
    }

    /**
     * @param string $dicPoverujiciho
     */
    public function setDicPoverujiciho($dicPoverujiciho)
    {
        $this->dicPoverujiciho = $dicPoverujiciho;
    }

    /**
     * @return int
     */
    public function getIdProvoz()
    {
        return $this->idProvoz;
    }

    /**
     * @param int $idProvoz
     */
    public function setIdProvoz($idProvoz)
    {
        $this->idProvoz = $idProvoz;
    }

    /**
     * @return string
     */
    public function getIdPokl()
    {
        return $this->idPokl;
    }

    /**
     * @param string $idPokl
     */
    public function setIdPokl($idPokl)
    {
        $this->idPokl = $idPokl;
    }

    /**
     * @return string
     */
    public function getPoradCis()
    {
        return $this->poradCis;
    }

    /**
     * @param string $poradCis
     */
    public function setPoradCis($poradCis)
    {
        $this->poradCis = $poradCis;
    }

    /**
     * @return string
     */
    public function getDatTrzby()
    {
        return $this->datTrzby;
    }

    /**
     * @param string $datTrzby
     */
    public function setDatTrzby($datTrzby)
    {
        $this->datTrzby = $datTrzby;
    }

    /**
     * @return float
     */
    public function getCelkTrzba()
    {
        return $this->celkTrzba;
    }

    /**
     * @param float $celkTrzba
     */
    public function setCelkTrzba($celkTrzba)
    {
        $this->celkTrzba = $celkTrzba;
    }

    /**
     * @return float
     */
    public function getZaklNepodlDph()
    {
        return $this->zaklNepodlDph;
    }

    /**
     * @param float $zaklNepodlDph
     */
    public function setZaklNepodlDph($zaklNepodlDph)
    {
        $this->zaklNepodlDph = $zaklNepodlDph;
    }

    /**
     * @return float
     */
    public function getZaklDan1()
    {
        return $this->zaklDan1;
    }

    /**
     * @param float $zaklDan1
     */
    public function setZaklDan1($zaklDan1)
    {
        $this->zaklDan1 = $zaklDan1;
    }

    /**
     * @return float
     */
    public function getDan1()
    {
        return $this->dan1;
    }

    /**
     * @param float $dan1
     */
    public function setDan1($dan1)
    {
        $this->dan1 = $dan1;
    }

    /**
     * @return float
     */
    public function getZaklDan2()
    {
        return $this->zaklDan2;
    }

    /**
     * @param float $zaklDan2
     */
    public function setZaklDan2($zaklDan2)
    {
        $this->zaklDan2 = $zaklDan2;
    }

    /**
     * @return float
     */
    public function getDan2()
    {
        return $this->dan2;
    }

    /**
     * @param float $dan2
     */
    public function setDan2($dan2)
    {
        $this->dan2 = $dan2;
    }

    /**
     * @return float
     */
    public function getZaklDan3()
    {
        return $this->zaklDan3;
    }

    /**
     * @param float $zaklDan3
     */
    public function setZaklDan3($zaklDan3)
    {
        $this->zaklDan3 = $zaklDan3;
    }

    /**
     * @return float
     */
    public function getDan3()
    {
        return $this->dan3;
    }

    /**
     * @param float $dan3
     */
    public function setDan3($dan3)
    {
        $this->dan3 = $dan3;
    }

    /**
     * @return float
     */
    public function getCestSluz()
    {
        return $this->cestSluz;
    }

    /**
     * @param float $cestSluz
     */
    public function setCestSluz($cestSluz)
    {
        $this->cestSluz = $cestSluz;
    }

    /**
     * @return float
     */
    public function getPouzitZboz1()
    {
        return $this->pouzitZboz1;
    }

    /**
     * @param float $pouzitZboz1
     */
    public function setPouzitZboz1($pouzitZboz1)
    {
        $this->pouzitZboz1 = $pouzitZboz1;
    }

    /**
     * @return float
     */
    public function getPouzitZboz2()
    {
        return $this->pouzitZboz2;
    }

    /**
     * @param float $pouzitZboz2
     */
    public function setPouzitZboz2($pouzitZboz2)
    {
        $this->pouzitZboz2 = $pouzitZboz2;
    }

    /**
     * @return float
     */
    public function getPouzitZboz3()
    {
        return $this->pouzitZboz3;
    }

    /**
     * @param float $pouzitZboz3
     */
    public function setPouzitZboz3($pouzitZboz3)
    {
        $this->pouzitZboz3 = $pouzitZboz3;
    }

    /**
     * @return float
     */
    public function getUrcenoCerpZuct()
    {
        return $this->urcenoCerpZuct;
    }

    /**
     * @param float $urcenoCerpZuct
     */
    public function setUrcenoCerpZuct($urcenoCerpZuct)
    {
        $this->urcenoCerpZuct = $urcenoCerpZuct;
    }

    /**
     * @return float
     */
    public function getCerpZuct()
    {
        return $this->cerpZuct;
    }

    /**
     * @param float $cerpZuct
     */
    public function setCerpZuct($cerpZuct)
    {
        $this->cerpZuct = $cerpZuct;
    }

    /**
     * @return int
     */
    public function getRezim()
    {
        return $this->rezim;
    }

    /**
     * @param int $rezim
     */
    public function setRezim($rezim)
    {
        $this->rezim = $rezim;
    }

    /**
     * @return string
     */
    public function getDatPrij()
    {
        return $this->datPrij;
    }

    /**
     * @param string $datPrij
     */
    public function setDatPrij($datPrij)
    {
        $this->datPrij = $datPrij;
    }

    /**
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param string $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * @return string
     */
    public function getKodVarov()
    {
        return $this->kodVarov;
    }

    /**
     * @param string $kodVarov
     */
    public function setKodVarov($kodVarov)
    {
        $this->kodVarov = $kodVarov;
    }

    /**
     * @return string
     */
    public function getVarovani()
    {
        return $this->varovani;
    }

    /**
     * @param string $varovani
     */
    public function setVarovani($varovani)
    {
        $this->varovani = $varovani;
    }


}

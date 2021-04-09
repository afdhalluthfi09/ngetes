<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for res_nilai_pemasaranonline
 */
class ResNilaiPemasaranonline extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $nik;
    public $chatting;
    public $skor_chatting;
    public $max_chatting;
    public $medsos;
    public $skor_medsos;
    public $max_medsos;
    public $marketplace;
    public $skor_mp;
    public $max_mp;
    public $gmb;
    public $skor_gmb;
    public $max_gmb;
    public $web;
    public $skor_web;
    public $max_web;
    public $updatemedsos;
    public $skor_updatemedsos;
    public $max_updatemedsos;
    public $updateweb;
    public $skor_updateweb;
    public $max_updateweb;
    public $seo;
    public $skor_seo;
    public $max_seo;
    public $iklan;
    public $skor_iklan;
    public $max_iklan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'res_nilai_pemasaranonline';
        $this->TableName = 'res_nilai_pemasaranonline';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`res_nilai_pemasaranonline`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // nik
        $this->nik = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // chatting
        $this->chatting = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_chatting', 'chatting', '`chatting`', '`chatting`', 200, 200, -1, false, '`chatting`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->chatting->Sortable = true; // Allow sort
        $this->chatting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->chatting->Param, "CustomMsg");
        $this->Fields['chatting'] = &$this->chatting;

        // skor_chatting
        $this->skor_chatting = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_chatting', 'skor_chatting', '`skor_chatting`', '`skor_chatting`', 5, 23, -1, false, '`skor_chatting`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_chatting->Sortable = true; // Allow sort
        $this->skor_chatting->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_chatting->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_chatting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_chatting->Param, "CustomMsg");
        $this->Fields['skor_chatting'] = &$this->skor_chatting;

        // max_chatting
        $this->max_chatting = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_chatting', 'max_chatting', '`max_chatting`', '`max_chatting`', 5, 23, -1, false, '`max_chatting`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_chatting->Sortable = true; // Allow sort
        $this->max_chatting->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_chatting->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_chatting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_chatting->Param, "CustomMsg");
        $this->Fields['max_chatting'] = &$this->max_chatting;

        // medsos
        $this->medsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_medsos', 'medsos', '`medsos`', '`medsos`', 200, 200, -1, false, '`medsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->medsos->Sortable = true; // Allow sort
        $this->medsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->medsos->Param, "CustomMsg");
        $this->Fields['medsos'] = &$this->medsos;

        // skor_medsos
        $this->skor_medsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_medsos', 'skor_medsos', '`skor_medsos`', '`skor_medsos`', 5, 23, -1, false, '`skor_medsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_medsos->Sortable = true; // Allow sort
        $this->skor_medsos->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_medsos->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_medsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_medsos->Param, "CustomMsg");
        $this->Fields['skor_medsos'] = &$this->skor_medsos;

        // max_medsos
        $this->max_medsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_medsos', 'max_medsos', '`max_medsos`', '`max_medsos`', 5, 23, -1, false, '`max_medsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_medsos->Sortable = true; // Allow sort
        $this->max_medsos->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_medsos->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_medsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_medsos->Param, "CustomMsg");
        $this->Fields['max_medsos'] = &$this->max_medsos;

        // marketplace
        $this->marketplace = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_marketplace', 'marketplace', '`marketplace`', '`marketplace`', 200, 200, -1, false, '`marketplace`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->marketplace->Sortable = true; // Allow sort
        $this->marketplace->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->marketplace->Param, "CustomMsg");
        $this->Fields['marketplace'] = &$this->marketplace;

        // skor_mp
        $this->skor_mp = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_mp', 'skor_mp', '`skor_mp`', '`skor_mp`', 5, 23, -1, false, '`skor_mp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_mp->Sortable = true; // Allow sort
        $this->skor_mp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_mp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_mp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_mp->Param, "CustomMsg");
        $this->Fields['skor_mp'] = &$this->skor_mp;

        // max_mp
        $this->max_mp = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_mp', 'max_mp', '`max_mp`', '`max_mp`', 5, 23, -1, false, '`max_mp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_mp->Sortable = true; // Allow sort
        $this->max_mp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_mp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_mp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_mp->Param, "CustomMsg");
        $this->Fields['max_mp'] = &$this->max_mp;

        // gmb
        $this->gmb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_gmb', 'gmb', '`gmb`', '`gmb`', 200, 200, -1, false, '`gmb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gmb->Sortable = true; // Allow sort
        $this->gmb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gmb->Param, "CustomMsg");
        $this->Fields['gmb'] = &$this->gmb;

        // skor_gmb
        $this->skor_gmb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_gmb', 'skor_gmb', '`skor_gmb`', '`skor_gmb`', 5, 23, -1, false, '`skor_gmb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_gmb->Sortable = true; // Allow sort
        $this->skor_gmb->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_gmb->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_gmb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_gmb->Param, "CustomMsg");
        $this->Fields['skor_gmb'] = &$this->skor_gmb;

        // max_gmb
        $this->max_gmb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_gmb', 'max_gmb', '`max_gmb`', '`max_gmb`', 5, 23, -1, false, '`max_gmb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_gmb->Sortable = true; // Allow sort
        $this->max_gmb->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_gmb->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_gmb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_gmb->Param, "CustomMsg");
        $this->Fields['max_gmb'] = &$this->max_gmb;

        // web
        $this->web = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_web', 'web', '`web`', '`web`', 200, 200, -1, false, '`web`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->web->Sortable = true; // Allow sort
        $this->web->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->web->Param, "CustomMsg");
        $this->Fields['web'] = &$this->web;

        // skor_web
        $this->skor_web = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_web', 'skor_web', '`skor_web`', '`skor_web`', 5, 23, -1, false, '`skor_web`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_web->Sortable = true; // Allow sort
        $this->skor_web->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_web->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_web->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_web->Param, "CustomMsg");
        $this->Fields['skor_web'] = &$this->skor_web;

        // max_web
        $this->max_web = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_web', 'max_web', '`max_web`', '`max_web`', 5, 23, -1, false, '`max_web`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_web->Sortable = true; // Allow sort
        $this->max_web->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_web->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_web->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_web->Param, "CustomMsg");
        $this->Fields['max_web'] = &$this->max_web;

        // updatemedsos
        $this->updatemedsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_updatemedsos', 'updatemedsos', '`updatemedsos`', '`updatemedsos`', 200, 200, -1, false, '`updatemedsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->updatemedsos->Sortable = true; // Allow sort
        $this->updatemedsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->updatemedsos->Param, "CustomMsg");
        $this->Fields['updatemedsos'] = &$this->updatemedsos;

        // skor_updatemedsos
        $this->skor_updatemedsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_updatemedsos', 'skor_updatemedsos', '`skor_updatemedsos`', '`skor_updatemedsos`', 5, 23, -1, false, '`skor_updatemedsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_updatemedsos->Sortable = true; // Allow sort
        $this->skor_updatemedsos->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_updatemedsos->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_updatemedsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_updatemedsos->Param, "CustomMsg");
        $this->Fields['skor_updatemedsos'] = &$this->skor_updatemedsos;

        // max_updatemedsos
        $this->max_updatemedsos = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_updatemedsos', 'max_updatemedsos', '`max_updatemedsos`', '`max_updatemedsos`', 5, 23, -1, false, '`max_updatemedsos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_updatemedsos->Sortable = true; // Allow sort
        $this->max_updatemedsos->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_updatemedsos->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_updatemedsos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_updatemedsos->Param, "CustomMsg");
        $this->Fields['max_updatemedsos'] = &$this->max_updatemedsos;

        // updateweb
        $this->updateweb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_updateweb', 'updateweb', '`updateweb`', '`updateweb`', 200, 200, -1, false, '`updateweb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->updateweb->Sortable = true; // Allow sort
        $this->updateweb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->updateweb->Param, "CustomMsg");
        $this->Fields['updateweb'] = &$this->updateweb;

        // skor_updateweb
        $this->skor_updateweb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_updateweb', 'skor_updateweb', '`skor_updateweb`', '`skor_updateweb`', 5, 23, -1, false, '`skor_updateweb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_updateweb->Sortable = true; // Allow sort
        $this->skor_updateweb->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_updateweb->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_updateweb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_updateweb->Param, "CustomMsg");
        $this->Fields['skor_updateweb'] = &$this->skor_updateweb;

        // max_updateweb
        $this->max_updateweb = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_updateweb', 'max_updateweb', '`max_updateweb`', '`max_updateweb`', 5, 23, -1, false, '`max_updateweb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_updateweb->Sortable = true; // Allow sort
        $this->max_updateweb->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_updateweb->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_updateweb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_updateweb->Param, "CustomMsg");
        $this->Fields['max_updateweb'] = &$this->max_updateweb;

        // seo
        $this->seo = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_seo', 'seo', '`seo`', '`seo`', 200, 200, -1, false, '`seo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->seo->Sortable = true; // Allow sort
        $this->seo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->seo->Param, "CustomMsg");
        $this->Fields['seo'] = &$this->seo;

        // skor_seo
        $this->skor_seo = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_seo', 'skor_seo', '`skor_seo`', '`skor_seo`', 5, 23, -1, false, '`skor_seo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_seo->Sortable = true; // Allow sort
        $this->skor_seo->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_seo->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_seo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_seo->Param, "CustomMsg");
        $this->Fields['skor_seo'] = &$this->skor_seo;

        // max_seo
        $this->max_seo = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_seo', 'max_seo', '`max_seo`', '`max_seo`', 5, 23, -1, false, '`max_seo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_seo->Sortable = true; // Allow sort
        $this->max_seo->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_seo->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_seo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_seo->Param, "CustomMsg");
        $this->Fields['max_seo'] = &$this->max_seo;

        // iklan
        $this->iklan = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_iklan', 'iklan', '`iklan`', '`iklan`', 200, 200, -1, false, '`iklan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->iklan->Sortable = true; // Allow sort
        $this->iklan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->iklan->Param, "CustomMsg");
        $this->Fields['iklan'] = &$this->iklan;

        // skor_iklan
        $this->skor_iklan = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_skor_iklan', 'skor_iklan', '`skor_iklan`', '`skor_iklan`', 5, 23, -1, false, '`skor_iklan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_iklan->Sortable = true; // Allow sort
        $this->skor_iklan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_iklan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_iklan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_iklan->Param, "CustomMsg");
        $this->Fields['skor_iklan'] = &$this->skor_iklan;

        // max_iklan
        $this->max_iklan = new DbField('res_nilai_pemasaranonline', 'res_nilai_pemasaranonline', 'x_max_iklan', 'max_iklan', '`max_iklan`', '`max_iklan`', 5, 23, -1, false, '`max_iklan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_iklan->Sortable = true; // Allow sort
        $this->max_iklan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_iklan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_iklan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_iklan->Param, "CustomMsg");
        $this->Fields['max_iklan'] = &$this->max_iklan;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`res_nilai_pemasaranonline`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('nik', $rs)) {
                AddFilter($where, QuotedName('nik', $this->Dbid) . '=' . QuotedValue($rs['nik'], $this->nik->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->nik->DbValue = $row['nik'];
        $this->chatting->DbValue = $row['chatting'];
        $this->skor_chatting->DbValue = $row['skor_chatting'];
        $this->max_chatting->DbValue = $row['max_chatting'];
        $this->medsos->DbValue = $row['medsos'];
        $this->skor_medsos->DbValue = $row['skor_medsos'];
        $this->max_medsos->DbValue = $row['max_medsos'];
        $this->marketplace->DbValue = $row['marketplace'];
        $this->skor_mp->DbValue = $row['skor_mp'];
        $this->max_mp->DbValue = $row['max_mp'];
        $this->gmb->DbValue = $row['gmb'];
        $this->skor_gmb->DbValue = $row['skor_gmb'];
        $this->max_gmb->DbValue = $row['max_gmb'];
        $this->web->DbValue = $row['web'];
        $this->skor_web->DbValue = $row['skor_web'];
        $this->max_web->DbValue = $row['max_web'];
        $this->updatemedsos->DbValue = $row['updatemedsos'];
        $this->skor_updatemedsos->DbValue = $row['skor_updatemedsos'];
        $this->max_updatemedsos->DbValue = $row['max_updatemedsos'];
        $this->updateweb->DbValue = $row['updateweb'];
        $this->skor_updateweb->DbValue = $row['skor_updateweb'];
        $this->max_updateweb->DbValue = $row['max_updateweb'];
        $this->seo->DbValue = $row['seo'];
        $this->skor_seo->DbValue = $row['skor_seo'];
        $this->max_seo->DbValue = $row['max_seo'];
        $this->iklan->DbValue = $row['iklan'];
        $this->skor_iklan->DbValue = $row['skor_iklan'];
        $this->max_iklan->DbValue = $row['max_iklan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`nik` = '@nik@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->nik->CurrentValue : $this->nik->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->nik->CurrentValue = $keys[0];
            } else {
                $this->nik->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('nik', $row) ? $row['nik'] : null;
        } else {
            $val = $this->nik->OldValue !== null ? $this->nik->OldValue : $this->nik->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@nik@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("resnilaipemasaranonlinelist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "resnilaipemasaranonlineview") {
            return $Language->phrase("View");
        } elseif ($pageName == "resnilaipemasaranonlineedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "resnilaipemasaranonlineadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ResNilaiPemasaranonlineView";
            case Config("API_ADD_ACTION"):
                return "ResNilaiPemasaranonlineAdd";
            case Config("API_EDIT_ACTION"):
                return "ResNilaiPemasaranonlineEdit";
            case Config("API_DELETE_ACTION"):
                return "ResNilaiPemasaranonlineDelete";
            case Config("API_LIST_ACTION"):
                return "ResNilaiPemasaranonlineList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "resnilaipemasaranonlinelist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("resnilaipemasaranonlineview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("resnilaipemasaranonlineview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "resnilaipemasaranonlineadd?" . $this->getUrlParm($parm);
        } else {
            $url = "resnilaipemasaranonlineadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("resnilaipemasaranonlineedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("resnilaipemasaranonlineadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("resnilaipemasaranonlinedelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "nik:" . JsonEncode($this->nik->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->nik->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->nik->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("nik") ?? Route("nik")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->nik->CurrentValue = $key;
            } else {
                $this->nik->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->nik->setDbValue($row['nik']);
        $this->chatting->setDbValue($row['chatting']);
        $this->skor_chatting->setDbValue($row['skor_chatting']);
        $this->max_chatting->setDbValue($row['max_chatting']);
        $this->medsos->setDbValue($row['medsos']);
        $this->skor_medsos->setDbValue($row['skor_medsos']);
        $this->max_medsos->setDbValue($row['max_medsos']);
        $this->marketplace->setDbValue($row['marketplace']);
        $this->skor_mp->setDbValue($row['skor_mp']);
        $this->max_mp->setDbValue($row['max_mp']);
        $this->gmb->setDbValue($row['gmb']);
        $this->skor_gmb->setDbValue($row['skor_gmb']);
        $this->max_gmb->setDbValue($row['max_gmb']);
        $this->web->setDbValue($row['web']);
        $this->skor_web->setDbValue($row['skor_web']);
        $this->max_web->setDbValue($row['max_web']);
        $this->updatemedsos->setDbValue($row['updatemedsos']);
        $this->skor_updatemedsos->setDbValue($row['skor_updatemedsos']);
        $this->max_updatemedsos->setDbValue($row['max_updatemedsos']);
        $this->updateweb->setDbValue($row['updateweb']);
        $this->skor_updateweb->setDbValue($row['skor_updateweb']);
        $this->max_updateweb->setDbValue($row['max_updateweb']);
        $this->seo->setDbValue($row['seo']);
        $this->skor_seo->setDbValue($row['skor_seo']);
        $this->max_seo->setDbValue($row['max_seo']);
        $this->iklan->setDbValue($row['iklan']);
        $this->skor_iklan->setDbValue($row['skor_iklan']);
        $this->max_iklan->setDbValue($row['max_iklan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // chatting

        // skor_chatting

        // max_chatting

        // medsos

        // skor_medsos

        // max_medsos

        // marketplace

        // skor_mp

        // max_mp

        // gmb

        // skor_gmb

        // max_gmb

        // web

        // skor_web

        // max_web

        // updatemedsos

        // skor_updatemedsos

        // max_updatemedsos

        // updateweb

        // skor_updateweb

        // max_updateweb

        // seo

        // skor_seo

        // max_seo

        // iklan

        // skor_iklan

        // max_iklan

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // chatting
        $this->chatting->ViewValue = $this->chatting->CurrentValue;
        $this->chatting->ViewCustomAttributes = "";

        // skor_chatting
        $this->skor_chatting->ViewValue = $this->skor_chatting->CurrentValue;
        $this->skor_chatting->ViewValue = FormatNumber($this->skor_chatting->ViewValue, 2, -2, -2, -2);
        $this->skor_chatting->ViewCustomAttributes = "";

        // max_chatting
        $this->max_chatting->ViewValue = $this->max_chatting->CurrentValue;
        $this->max_chatting->ViewValue = FormatNumber($this->max_chatting->ViewValue, 2, -2, -2, -2);
        $this->max_chatting->ViewCustomAttributes = "";

        // medsos
        $this->medsos->ViewValue = $this->medsos->CurrentValue;
        $this->medsos->ViewCustomAttributes = "";

        // skor_medsos
        $this->skor_medsos->ViewValue = $this->skor_medsos->CurrentValue;
        $this->skor_medsos->ViewValue = FormatNumber($this->skor_medsos->ViewValue, 2, -2, -2, -2);
        $this->skor_medsos->ViewCustomAttributes = "";

        // max_medsos
        $this->max_medsos->ViewValue = $this->max_medsos->CurrentValue;
        $this->max_medsos->ViewValue = FormatNumber($this->max_medsos->ViewValue, 2, -2, -2, -2);
        $this->max_medsos->ViewCustomAttributes = "";

        // marketplace
        $this->marketplace->ViewValue = $this->marketplace->CurrentValue;
        $this->marketplace->ViewCustomAttributes = "";

        // skor_mp
        $this->skor_mp->ViewValue = $this->skor_mp->CurrentValue;
        $this->skor_mp->ViewValue = FormatNumber($this->skor_mp->ViewValue, 2, -2, -2, -2);
        $this->skor_mp->ViewCustomAttributes = "";

        // max_mp
        $this->max_mp->ViewValue = $this->max_mp->CurrentValue;
        $this->max_mp->ViewValue = FormatNumber($this->max_mp->ViewValue, 2, -2, -2, -2);
        $this->max_mp->ViewCustomAttributes = "";

        // gmb
        $this->gmb->ViewValue = $this->gmb->CurrentValue;
        $this->gmb->ViewCustomAttributes = "";

        // skor_gmb
        $this->skor_gmb->ViewValue = $this->skor_gmb->CurrentValue;
        $this->skor_gmb->ViewValue = FormatNumber($this->skor_gmb->ViewValue, 2, -2, -2, -2);
        $this->skor_gmb->ViewCustomAttributes = "";

        // max_gmb
        $this->max_gmb->ViewValue = $this->max_gmb->CurrentValue;
        $this->max_gmb->ViewValue = FormatNumber($this->max_gmb->ViewValue, 2, -2, -2, -2);
        $this->max_gmb->ViewCustomAttributes = "";

        // web
        $this->web->ViewValue = $this->web->CurrentValue;
        $this->web->ViewCustomAttributes = "";

        // skor_web
        $this->skor_web->ViewValue = $this->skor_web->CurrentValue;
        $this->skor_web->ViewValue = FormatNumber($this->skor_web->ViewValue, 2, -2, -2, -2);
        $this->skor_web->ViewCustomAttributes = "";

        // max_web
        $this->max_web->ViewValue = $this->max_web->CurrentValue;
        $this->max_web->ViewValue = FormatNumber($this->max_web->ViewValue, 2, -2, -2, -2);
        $this->max_web->ViewCustomAttributes = "";

        // updatemedsos
        $this->updatemedsos->ViewValue = $this->updatemedsos->CurrentValue;
        $this->updatemedsos->ViewCustomAttributes = "";

        // skor_updatemedsos
        $this->skor_updatemedsos->ViewValue = $this->skor_updatemedsos->CurrentValue;
        $this->skor_updatemedsos->ViewValue = FormatNumber($this->skor_updatemedsos->ViewValue, 2, -2, -2, -2);
        $this->skor_updatemedsos->ViewCustomAttributes = "";

        // max_updatemedsos
        $this->max_updatemedsos->ViewValue = $this->max_updatemedsos->CurrentValue;
        $this->max_updatemedsos->ViewValue = FormatNumber($this->max_updatemedsos->ViewValue, 2, -2, -2, -2);
        $this->max_updatemedsos->ViewCustomAttributes = "";

        // updateweb
        $this->updateweb->ViewValue = $this->updateweb->CurrentValue;
        $this->updateweb->ViewCustomAttributes = "";

        // skor_updateweb
        $this->skor_updateweb->ViewValue = $this->skor_updateweb->CurrentValue;
        $this->skor_updateweb->ViewValue = FormatNumber($this->skor_updateweb->ViewValue, 2, -2, -2, -2);
        $this->skor_updateweb->ViewCustomAttributes = "";

        // max_updateweb
        $this->max_updateweb->ViewValue = $this->max_updateweb->CurrentValue;
        $this->max_updateweb->ViewValue = FormatNumber($this->max_updateweb->ViewValue, 2, -2, -2, -2);
        $this->max_updateweb->ViewCustomAttributes = "";

        // seo
        $this->seo->ViewValue = $this->seo->CurrentValue;
        $this->seo->ViewCustomAttributes = "";

        // skor_seo
        $this->skor_seo->ViewValue = $this->skor_seo->CurrentValue;
        $this->skor_seo->ViewValue = FormatNumber($this->skor_seo->ViewValue, 2, -2, -2, -2);
        $this->skor_seo->ViewCustomAttributes = "";

        // max_seo
        $this->max_seo->ViewValue = $this->max_seo->CurrentValue;
        $this->max_seo->ViewValue = FormatNumber($this->max_seo->ViewValue, 2, -2, -2, -2);
        $this->max_seo->ViewCustomAttributes = "";

        // iklan
        $this->iklan->ViewValue = $this->iklan->CurrentValue;
        $this->iklan->ViewCustomAttributes = "";

        // skor_iklan
        $this->skor_iklan->ViewValue = $this->skor_iklan->CurrentValue;
        $this->skor_iklan->ViewValue = FormatNumber($this->skor_iklan->ViewValue, 2, -2, -2, -2);
        $this->skor_iklan->ViewCustomAttributes = "";

        // max_iklan
        $this->max_iklan->ViewValue = $this->max_iklan->CurrentValue;
        $this->max_iklan->ViewValue = FormatNumber($this->max_iklan->ViewValue, 2, -2, -2, -2);
        $this->max_iklan->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // chatting
        $this->chatting->LinkCustomAttributes = "";
        $this->chatting->HrefValue = "";
        $this->chatting->TooltipValue = "";

        // skor_chatting
        $this->skor_chatting->LinkCustomAttributes = "";
        $this->skor_chatting->HrefValue = "";
        $this->skor_chatting->TooltipValue = "";

        // max_chatting
        $this->max_chatting->LinkCustomAttributes = "";
        $this->max_chatting->HrefValue = "";
        $this->max_chatting->TooltipValue = "";

        // medsos
        $this->medsos->LinkCustomAttributes = "";
        $this->medsos->HrefValue = "";
        $this->medsos->TooltipValue = "";

        // skor_medsos
        $this->skor_medsos->LinkCustomAttributes = "";
        $this->skor_medsos->HrefValue = "";
        $this->skor_medsos->TooltipValue = "";

        // max_medsos
        $this->max_medsos->LinkCustomAttributes = "";
        $this->max_medsos->HrefValue = "";
        $this->max_medsos->TooltipValue = "";

        // marketplace
        $this->marketplace->LinkCustomAttributes = "";
        $this->marketplace->HrefValue = "";
        $this->marketplace->TooltipValue = "";

        // skor_mp
        $this->skor_mp->LinkCustomAttributes = "";
        $this->skor_mp->HrefValue = "";
        $this->skor_mp->TooltipValue = "";

        // max_mp
        $this->max_mp->LinkCustomAttributes = "";
        $this->max_mp->HrefValue = "";
        $this->max_mp->TooltipValue = "";

        // gmb
        $this->gmb->LinkCustomAttributes = "";
        $this->gmb->HrefValue = "";
        $this->gmb->TooltipValue = "";

        // skor_gmb
        $this->skor_gmb->LinkCustomAttributes = "";
        $this->skor_gmb->HrefValue = "";
        $this->skor_gmb->TooltipValue = "";

        // max_gmb
        $this->max_gmb->LinkCustomAttributes = "";
        $this->max_gmb->HrefValue = "";
        $this->max_gmb->TooltipValue = "";

        // web
        $this->web->LinkCustomAttributes = "";
        $this->web->HrefValue = "";
        $this->web->TooltipValue = "";

        // skor_web
        $this->skor_web->LinkCustomAttributes = "";
        $this->skor_web->HrefValue = "";
        $this->skor_web->TooltipValue = "";

        // max_web
        $this->max_web->LinkCustomAttributes = "";
        $this->max_web->HrefValue = "";
        $this->max_web->TooltipValue = "";

        // updatemedsos
        $this->updatemedsos->LinkCustomAttributes = "";
        $this->updatemedsos->HrefValue = "";
        $this->updatemedsos->TooltipValue = "";

        // skor_updatemedsos
        $this->skor_updatemedsos->LinkCustomAttributes = "";
        $this->skor_updatemedsos->HrefValue = "";
        $this->skor_updatemedsos->TooltipValue = "";

        // max_updatemedsos
        $this->max_updatemedsos->LinkCustomAttributes = "";
        $this->max_updatemedsos->HrefValue = "";
        $this->max_updatemedsos->TooltipValue = "";

        // updateweb
        $this->updateweb->LinkCustomAttributes = "";
        $this->updateweb->HrefValue = "";
        $this->updateweb->TooltipValue = "";

        // skor_updateweb
        $this->skor_updateweb->LinkCustomAttributes = "";
        $this->skor_updateweb->HrefValue = "";
        $this->skor_updateweb->TooltipValue = "";

        // max_updateweb
        $this->max_updateweb->LinkCustomAttributes = "";
        $this->max_updateweb->HrefValue = "";
        $this->max_updateweb->TooltipValue = "";

        // seo
        $this->seo->LinkCustomAttributes = "";
        $this->seo->HrefValue = "";
        $this->seo->TooltipValue = "";

        // skor_seo
        $this->skor_seo->LinkCustomAttributes = "";
        $this->skor_seo->HrefValue = "";
        $this->skor_seo->TooltipValue = "";

        // max_seo
        $this->max_seo->LinkCustomAttributes = "";
        $this->max_seo->HrefValue = "";
        $this->max_seo->TooltipValue = "";

        // iklan
        $this->iklan->LinkCustomAttributes = "";
        $this->iklan->HrefValue = "";
        $this->iklan->TooltipValue = "";

        // skor_iklan
        $this->skor_iklan->LinkCustomAttributes = "";
        $this->skor_iklan->HrefValue = "";
        $this->skor_iklan->TooltipValue = "";

        // max_iklan
        $this->max_iklan->LinkCustomAttributes = "";
        $this->max_iklan->HrefValue = "";
        $this->max_iklan->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        if (!$this->nik->Raw) {
            $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
        }
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // chatting
        $this->chatting->EditAttrs["class"] = "form-control";
        $this->chatting->EditCustomAttributes = "";
        if (!$this->chatting->Raw) {
            $this->chatting->CurrentValue = HtmlDecode($this->chatting->CurrentValue);
        }
        $this->chatting->EditValue = $this->chatting->CurrentValue;
        $this->chatting->PlaceHolder = RemoveHtml($this->chatting->caption());

        // skor_chatting
        $this->skor_chatting->EditAttrs["class"] = "form-control";
        $this->skor_chatting->EditCustomAttributes = "";
        $this->skor_chatting->EditValue = $this->skor_chatting->CurrentValue;
        $this->skor_chatting->PlaceHolder = RemoveHtml($this->skor_chatting->caption());
        if (strval($this->skor_chatting->EditValue) != "" && is_numeric($this->skor_chatting->EditValue)) {
            $this->skor_chatting->EditValue = FormatNumber($this->skor_chatting->EditValue, -2, -2, -2, -2);
        }

        // max_chatting
        $this->max_chatting->EditAttrs["class"] = "form-control";
        $this->max_chatting->EditCustomAttributes = "";
        $this->max_chatting->EditValue = $this->max_chatting->CurrentValue;
        $this->max_chatting->PlaceHolder = RemoveHtml($this->max_chatting->caption());
        if (strval($this->max_chatting->EditValue) != "" && is_numeric($this->max_chatting->EditValue)) {
            $this->max_chatting->EditValue = FormatNumber($this->max_chatting->EditValue, -2, -2, -2, -2);
        }

        // medsos
        $this->medsos->EditAttrs["class"] = "form-control";
        $this->medsos->EditCustomAttributes = "";
        if (!$this->medsos->Raw) {
            $this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
        }
        $this->medsos->EditValue = $this->medsos->CurrentValue;
        $this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

        // skor_medsos
        $this->skor_medsos->EditAttrs["class"] = "form-control";
        $this->skor_medsos->EditCustomAttributes = "";
        $this->skor_medsos->EditValue = $this->skor_medsos->CurrentValue;
        $this->skor_medsos->PlaceHolder = RemoveHtml($this->skor_medsos->caption());
        if (strval($this->skor_medsos->EditValue) != "" && is_numeric($this->skor_medsos->EditValue)) {
            $this->skor_medsos->EditValue = FormatNumber($this->skor_medsos->EditValue, -2, -2, -2, -2);
        }

        // max_medsos
        $this->max_medsos->EditAttrs["class"] = "form-control";
        $this->max_medsos->EditCustomAttributes = "";
        $this->max_medsos->EditValue = $this->max_medsos->CurrentValue;
        $this->max_medsos->PlaceHolder = RemoveHtml($this->max_medsos->caption());
        if (strval($this->max_medsos->EditValue) != "" && is_numeric($this->max_medsos->EditValue)) {
            $this->max_medsos->EditValue = FormatNumber($this->max_medsos->EditValue, -2, -2, -2, -2);
        }

        // marketplace
        $this->marketplace->EditAttrs["class"] = "form-control";
        $this->marketplace->EditCustomAttributes = "";
        if (!$this->marketplace->Raw) {
            $this->marketplace->CurrentValue = HtmlDecode($this->marketplace->CurrentValue);
        }
        $this->marketplace->EditValue = $this->marketplace->CurrentValue;
        $this->marketplace->PlaceHolder = RemoveHtml($this->marketplace->caption());

        // skor_mp
        $this->skor_mp->EditAttrs["class"] = "form-control";
        $this->skor_mp->EditCustomAttributes = "";
        $this->skor_mp->EditValue = $this->skor_mp->CurrentValue;
        $this->skor_mp->PlaceHolder = RemoveHtml($this->skor_mp->caption());
        if (strval($this->skor_mp->EditValue) != "" && is_numeric($this->skor_mp->EditValue)) {
            $this->skor_mp->EditValue = FormatNumber($this->skor_mp->EditValue, -2, -2, -2, -2);
        }

        // max_mp
        $this->max_mp->EditAttrs["class"] = "form-control";
        $this->max_mp->EditCustomAttributes = "";
        $this->max_mp->EditValue = $this->max_mp->CurrentValue;
        $this->max_mp->PlaceHolder = RemoveHtml($this->max_mp->caption());
        if (strval($this->max_mp->EditValue) != "" && is_numeric($this->max_mp->EditValue)) {
            $this->max_mp->EditValue = FormatNumber($this->max_mp->EditValue, -2, -2, -2, -2);
        }

        // gmb
        $this->gmb->EditAttrs["class"] = "form-control";
        $this->gmb->EditCustomAttributes = "";
        if (!$this->gmb->Raw) {
            $this->gmb->CurrentValue = HtmlDecode($this->gmb->CurrentValue);
        }
        $this->gmb->EditValue = $this->gmb->CurrentValue;
        $this->gmb->PlaceHolder = RemoveHtml($this->gmb->caption());

        // skor_gmb
        $this->skor_gmb->EditAttrs["class"] = "form-control";
        $this->skor_gmb->EditCustomAttributes = "";
        $this->skor_gmb->EditValue = $this->skor_gmb->CurrentValue;
        $this->skor_gmb->PlaceHolder = RemoveHtml($this->skor_gmb->caption());
        if (strval($this->skor_gmb->EditValue) != "" && is_numeric($this->skor_gmb->EditValue)) {
            $this->skor_gmb->EditValue = FormatNumber($this->skor_gmb->EditValue, -2, -2, -2, -2);
        }

        // max_gmb
        $this->max_gmb->EditAttrs["class"] = "form-control";
        $this->max_gmb->EditCustomAttributes = "";
        $this->max_gmb->EditValue = $this->max_gmb->CurrentValue;
        $this->max_gmb->PlaceHolder = RemoveHtml($this->max_gmb->caption());
        if (strval($this->max_gmb->EditValue) != "" && is_numeric($this->max_gmb->EditValue)) {
            $this->max_gmb->EditValue = FormatNumber($this->max_gmb->EditValue, -2, -2, -2, -2);
        }

        // web
        $this->web->EditAttrs["class"] = "form-control";
        $this->web->EditCustomAttributes = "";
        if (!$this->web->Raw) {
            $this->web->CurrentValue = HtmlDecode($this->web->CurrentValue);
        }
        $this->web->EditValue = $this->web->CurrentValue;
        $this->web->PlaceHolder = RemoveHtml($this->web->caption());

        // skor_web
        $this->skor_web->EditAttrs["class"] = "form-control";
        $this->skor_web->EditCustomAttributes = "";
        $this->skor_web->EditValue = $this->skor_web->CurrentValue;
        $this->skor_web->PlaceHolder = RemoveHtml($this->skor_web->caption());
        if (strval($this->skor_web->EditValue) != "" && is_numeric($this->skor_web->EditValue)) {
            $this->skor_web->EditValue = FormatNumber($this->skor_web->EditValue, -2, -2, -2, -2);
        }

        // max_web
        $this->max_web->EditAttrs["class"] = "form-control";
        $this->max_web->EditCustomAttributes = "";
        $this->max_web->EditValue = $this->max_web->CurrentValue;
        $this->max_web->PlaceHolder = RemoveHtml($this->max_web->caption());
        if (strval($this->max_web->EditValue) != "" && is_numeric($this->max_web->EditValue)) {
            $this->max_web->EditValue = FormatNumber($this->max_web->EditValue, -2, -2, -2, -2);
        }

        // updatemedsos
        $this->updatemedsos->EditAttrs["class"] = "form-control";
        $this->updatemedsos->EditCustomAttributes = "";
        if (!$this->updatemedsos->Raw) {
            $this->updatemedsos->CurrentValue = HtmlDecode($this->updatemedsos->CurrentValue);
        }
        $this->updatemedsos->EditValue = $this->updatemedsos->CurrentValue;
        $this->updatemedsos->PlaceHolder = RemoveHtml($this->updatemedsos->caption());

        // skor_updatemedsos
        $this->skor_updatemedsos->EditAttrs["class"] = "form-control";
        $this->skor_updatemedsos->EditCustomAttributes = "";
        $this->skor_updatemedsos->EditValue = $this->skor_updatemedsos->CurrentValue;
        $this->skor_updatemedsos->PlaceHolder = RemoveHtml($this->skor_updatemedsos->caption());
        if (strval($this->skor_updatemedsos->EditValue) != "" && is_numeric($this->skor_updatemedsos->EditValue)) {
            $this->skor_updatemedsos->EditValue = FormatNumber($this->skor_updatemedsos->EditValue, -2, -2, -2, -2);
        }

        // max_updatemedsos
        $this->max_updatemedsos->EditAttrs["class"] = "form-control";
        $this->max_updatemedsos->EditCustomAttributes = "";
        $this->max_updatemedsos->EditValue = $this->max_updatemedsos->CurrentValue;
        $this->max_updatemedsos->PlaceHolder = RemoveHtml($this->max_updatemedsos->caption());
        if (strval($this->max_updatemedsos->EditValue) != "" && is_numeric($this->max_updatemedsos->EditValue)) {
            $this->max_updatemedsos->EditValue = FormatNumber($this->max_updatemedsos->EditValue, -2, -2, -2, -2);
        }

        // updateweb
        $this->updateweb->EditAttrs["class"] = "form-control";
        $this->updateweb->EditCustomAttributes = "";
        if (!$this->updateweb->Raw) {
            $this->updateweb->CurrentValue = HtmlDecode($this->updateweb->CurrentValue);
        }
        $this->updateweb->EditValue = $this->updateweb->CurrentValue;
        $this->updateweb->PlaceHolder = RemoveHtml($this->updateweb->caption());

        // skor_updateweb
        $this->skor_updateweb->EditAttrs["class"] = "form-control";
        $this->skor_updateweb->EditCustomAttributes = "";
        $this->skor_updateweb->EditValue = $this->skor_updateweb->CurrentValue;
        $this->skor_updateweb->PlaceHolder = RemoveHtml($this->skor_updateweb->caption());
        if (strval($this->skor_updateweb->EditValue) != "" && is_numeric($this->skor_updateweb->EditValue)) {
            $this->skor_updateweb->EditValue = FormatNumber($this->skor_updateweb->EditValue, -2, -2, -2, -2);
        }

        // max_updateweb
        $this->max_updateweb->EditAttrs["class"] = "form-control";
        $this->max_updateweb->EditCustomAttributes = "";
        $this->max_updateweb->EditValue = $this->max_updateweb->CurrentValue;
        $this->max_updateweb->PlaceHolder = RemoveHtml($this->max_updateweb->caption());
        if (strval($this->max_updateweb->EditValue) != "" && is_numeric($this->max_updateweb->EditValue)) {
            $this->max_updateweb->EditValue = FormatNumber($this->max_updateweb->EditValue, -2, -2, -2, -2);
        }

        // seo
        $this->seo->EditAttrs["class"] = "form-control";
        $this->seo->EditCustomAttributes = "";
        if (!$this->seo->Raw) {
            $this->seo->CurrentValue = HtmlDecode($this->seo->CurrentValue);
        }
        $this->seo->EditValue = $this->seo->CurrentValue;
        $this->seo->PlaceHolder = RemoveHtml($this->seo->caption());

        // skor_seo
        $this->skor_seo->EditAttrs["class"] = "form-control";
        $this->skor_seo->EditCustomAttributes = "";
        $this->skor_seo->EditValue = $this->skor_seo->CurrentValue;
        $this->skor_seo->PlaceHolder = RemoveHtml($this->skor_seo->caption());
        if (strval($this->skor_seo->EditValue) != "" && is_numeric($this->skor_seo->EditValue)) {
            $this->skor_seo->EditValue = FormatNumber($this->skor_seo->EditValue, -2, -2, -2, -2);
        }

        // max_seo
        $this->max_seo->EditAttrs["class"] = "form-control";
        $this->max_seo->EditCustomAttributes = "";
        $this->max_seo->EditValue = $this->max_seo->CurrentValue;
        $this->max_seo->PlaceHolder = RemoveHtml($this->max_seo->caption());
        if (strval($this->max_seo->EditValue) != "" && is_numeric($this->max_seo->EditValue)) {
            $this->max_seo->EditValue = FormatNumber($this->max_seo->EditValue, -2, -2, -2, -2);
        }

        // iklan
        $this->iklan->EditAttrs["class"] = "form-control";
        $this->iklan->EditCustomAttributes = "";
        if (!$this->iklan->Raw) {
            $this->iklan->CurrentValue = HtmlDecode($this->iklan->CurrentValue);
        }
        $this->iklan->EditValue = $this->iklan->CurrentValue;
        $this->iklan->PlaceHolder = RemoveHtml($this->iklan->caption());

        // skor_iklan
        $this->skor_iklan->EditAttrs["class"] = "form-control";
        $this->skor_iklan->EditCustomAttributes = "";
        $this->skor_iklan->EditValue = $this->skor_iklan->CurrentValue;
        $this->skor_iklan->PlaceHolder = RemoveHtml($this->skor_iklan->caption());
        if (strval($this->skor_iklan->EditValue) != "" && is_numeric($this->skor_iklan->EditValue)) {
            $this->skor_iklan->EditValue = FormatNumber($this->skor_iklan->EditValue, -2, -2, -2, -2);
        }

        // max_iklan
        $this->max_iklan->EditAttrs["class"] = "form-control";
        $this->max_iklan->EditCustomAttributes = "";
        $this->max_iklan->EditValue = $this->max_iklan->CurrentValue;
        $this->max_iklan->PlaceHolder = RemoveHtml($this->max_iklan->caption());
        if (strval($this->max_iklan->EditValue) != "" && is_numeric($this->max_iklan->EditValue)) {
            $this->max_iklan->EditValue = FormatNumber($this->max_iklan->EditValue, -2, -2, -2, -2);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->chatting);
                    $doc->exportCaption($this->skor_chatting);
                    $doc->exportCaption($this->max_chatting);
                    $doc->exportCaption($this->medsos);
                    $doc->exportCaption($this->skor_medsos);
                    $doc->exportCaption($this->max_medsos);
                    $doc->exportCaption($this->marketplace);
                    $doc->exportCaption($this->skor_mp);
                    $doc->exportCaption($this->max_mp);
                    $doc->exportCaption($this->gmb);
                    $doc->exportCaption($this->skor_gmb);
                    $doc->exportCaption($this->max_gmb);
                    $doc->exportCaption($this->web);
                    $doc->exportCaption($this->skor_web);
                    $doc->exportCaption($this->max_web);
                    $doc->exportCaption($this->updatemedsos);
                    $doc->exportCaption($this->skor_updatemedsos);
                    $doc->exportCaption($this->max_updatemedsos);
                    $doc->exportCaption($this->updateweb);
                    $doc->exportCaption($this->skor_updateweb);
                    $doc->exportCaption($this->max_updateweb);
                    $doc->exportCaption($this->seo);
                    $doc->exportCaption($this->skor_seo);
                    $doc->exportCaption($this->max_seo);
                    $doc->exportCaption($this->iklan);
                    $doc->exportCaption($this->skor_iklan);
                    $doc->exportCaption($this->max_iklan);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->chatting);
                    $doc->exportCaption($this->skor_chatting);
                    $doc->exportCaption($this->max_chatting);
                    $doc->exportCaption($this->medsos);
                    $doc->exportCaption($this->skor_medsos);
                    $doc->exportCaption($this->max_medsos);
                    $doc->exportCaption($this->marketplace);
                    $doc->exportCaption($this->skor_mp);
                    $doc->exportCaption($this->max_mp);
                    $doc->exportCaption($this->gmb);
                    $doc->exportCaption($this->skor_gmb);
                    $doc->exportCaption($this->max_gmb);
                    $doc->exportCaption($this->web);
                    $doc->exportCaption($this->skor_web);
                    $doc->exportCaption($this->max_web);
                    $doc->exportCaption($this->updatemedsos);
                    $doc->exportCaption($this->skor_updatemedsos);
                    $doc->exportCaption($this->max_updatemedsos);
                    $doc->exportCaption($this->updateweb);
                    $doc->exportCaption($this->skor_updateweb);
                    $doc->exportCaption($this->max_updateweb);
                    $doc->exportCaption($this->seo);
                    $doc->exportCaption($this->skor_seo);
                    $doc->exportCaption($this->max_seo);
                    $doc->exportCaption($this->iklan);
                    $doc->exportCaption($this->skor_iklan);
                    $doc->exportCaption($this->max_iklan);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->chatting);
                        $doc->exportField($this->skor_chatting);
                        $doc->exportField($this->max_chatting);
                        $doc->exportField($this->medsos);
                        $doc->exportField($this->skor_medsos);
                        $doc->exportField($this->max_medsos);
                        $doc->exportField($this->marketplace);
                        $doc->exportField($this->skor_mp);
                        $doc->exportField($this->max_mp);
                        $doc->exportField($this->gmb);
                        $doc->exportField($this->skor_gmb);
                        $doc->exportField($this->max_gmb);
                        $doc->exportField($this->web);
                        $doc->exportField($this->skor_web);
                        $doc->exportField($this->max_web);
                        $doc->exportField($this->updatemedsos);
                        $doc->exportField($this->skor_updatemedsos);
                        $doc->exportField($this->max_updatemedsos);
                        $doc->exportField($this->updateweb);
                        $doc->exportField($this->skor_updateweb);
                        $doc->exportField($this->max_updateweb);
                        $doc->exportField($this->seo);
                        $doc->exportField($this->skor_seo);
                        $doc->exportField($this->max_seo);
                        $doc->exportField($this->iklan);
                        $doc->exportField($this->skor_iklan);
                        $doc->exportField($this->max_iklan);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->chatting);
                        $doc->exportField($this->skor_chatting);
                        $doc->exportField($this->max_chatting);
                        $doc->exportField($this->medsos);
                        $doc->exportField($this->skor_medsos);
                        $doc->exportField($this->max_medsos);
                        $doc->exportField($this->marketplace);
                        $doc->exportField($this->skor_mp);
                        $doc->exportField($this->max_mp);
                        $doc->exportField($this->gmb);
                        $doc->exportField($this->skor_gmb);
                        $doc->exportField($this->max_gmb);
                        $doc->exportField($this->web);
                        $doc->exportField($this->skor_web);
                        $doc->exportField($this->max_web);
                        $doc->exportField($this->updatemedsos);
                        $doc->exportField($this->skor_updatemedsos);
                        $doc->exportField($this->max_updatemedsos);
                        $doc->exportField($this->updateweb);
                        $doc->exportField($this->skor_updateweb);
                        $doc->exportField($this->max_updateweb);
                        $doc->exportField($this->seo);
                        $doc->exportField($this->skor_seo);
                        $doc->exportField($this->max_seo);
                        $doc->exportField($this->iklan);
                        $doc->exportField($this->skor_iklan);
                        $doc->exportField($this->max_iklan);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}

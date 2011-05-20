<?php

// Grid class, used to render JqGrid
class Grid
{
    private $_id;
    private $_altClass;
    private $_altRows;
    private $_autoEncode;
    private $_autoWidth;
    private $_caption;
    private $_columns = array();
    private $_dataType = 'json';
    private $_JsonReader = array('repeatitems' => 'false', 'id' => 0);
    private $_emptyRecords;
    private $_footerRow;
    private $_forceFit;
    private $_gridView;
    private $_headerTitles;
    private $_height;
    private $_hiddenGrid;
    private $_hideGrid;
    private $_hoverRows;
    private $_loadOnce;
    private $_loadText;
    private $_loadUi;
    private $_multiKey;
    private $_multiBoxOnly;
    private $_multiSelect;
    private $_multiSelectWidth;
    private $_onAfterInsertRow;
    private $_onBeforeRequest;
    private $_onBeforeSelectRow;
    private $_onGridComplete;
    private $_onLoadBeforeSend;
    private $_onLoadComplete;
    private $_onLoadError;
    private $_onCellSelect;
    private $_onDblClickRow;
    private $_onHeaderClick;
    private $_onPaging;
    private $_onRightClickRow;
    private $_onSelectAll;
    private $_onSelectRow;
    private $_onSortCol;
    private $_onResizeStart;
    private $_onResizeStop;
    private $_onSerializeGridData;
    private $_page;
    private $_pager;
    private $_pagerPos;
    private $_pgButtons;
    private $_pgInput;
    private $_pgText;
    private $_recordPos;
    private $_recordText;
    private $_requestMethod;
    private $_resizeClass;
    private $_rowList;
    private $_rowNum;
    private $_rowNumbers;
    private $_rowNumWidth;
    private $_scroll;
    private $_scrollInt;
    private $_scrollOffset;
    private $_scrollRows;
    private $_scrollTimeout;
    private $_shrinkToFit;
    private $_sortName;
    private $_sortOrder;
    private $_topPager;
    private $_toolbar;
    private $_toolbarPosition = 'top';
    private $_searchToolbar;
    private $_searchOnEnter;
    private $_searchClearButton;
    private $_searchToggleButton;
    private $_url;
    private $_viewRecords;
    private $_showAllSortIcons;
    private $_sortIconDirection;
    private $_sortOnHeaderClick;
    private $_width;

    /**
     * Constructor
     * @param string $id Id of grid
     */
    private function __construct($id)
    {
        if (trim($id) === '')
        {
            throw new Exception("Id must contain a value to identify the grid");
        }

        $this->_id = $id;
    }

    /**
     * Creates new instance of grid
     * @param string $id Id of grid
     * @return Grid
     */
    public static function create($id)
    {
        // This function exists so that a more fluent interface is possible.
        // PHP does not allow us to call methods directly on a newly constructed object.
        // new Grid('stuff')->addColumn() // fails
        // Grid::create('stuff')->addColumn() // works
        return new Grid($id);
    }

    /**
     * Adds column to grid
     * @param Column $colum
     * @return Grid
     */
    public function addColumn(Column $column)
    {
        $this->_columns[] = $column;

        return $this;
    }

    /**
     * The CSS class that is used for alternate rows. You can specify your own class and replace this value.
     * This option is valid only if altRows options is set to true (default: ui-priority-secondary)
     * @param string $altClass Classname for alternate rows
     * @return Grid
     */
    public function setAltClass($altClass)
    {
        $this->_altClass = $altClass;

        return $this;
    }

    /**
     * Set a zebra-striped grid (default: false)
     * @param boolean $altRows Boolean indicating if zebra-striped grid is used
     * @return Grid
     */
    public function setAltRows($altRows)
    {
        $this->_altRows = $altRows;

        return $this;
    }

    /**
     * When set to true encodes (html encode) the incoming (from server) and posted
     * data (from editing modules). For example < will be converted to &lt (default: false)
     * @param boolean indicating if autoencode is used
     * @return Grid
     */
    public function setAutoEncode($autoEncode)
    {
        if (!is_bool($autoEncode))
        {
            throw new Exception('AutoEncode is not a bool');
        }

        $this->_autoEncode = ($autoEncode === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * When set to true, the grid width is recalculated automatically to the width of the
     * parent element. This is done only initially when the grid is created. In order to
     * resize the grid when the parent element changes width you should apply custom code
     * and use a setGridWidth method for this purpose. (default: false)
     * @param boolean $autoWidth indicating if autowidth is used
     * @return Grid
     */
    public function setAutoWidth($autoWidth)
    {
        if (!is_bool($autoWidth))
        {
            throw new Exception('autoWidth is not a bool');
        }

        $this->_autoWidth = ($autoWidth === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * Specify the caption layer for the grid. This caption appears above the header layer.
     * If the string is empty the caption does not appear. (default: empty)
     * @param string $caption Caption of grid
     * @return Grid
     */
    public function setCaption($caption)
    {
        $this->_caption = $caption;

        return $this;
    }

    /**
     * Specify the format in which your datasource will supply data to the grid. Valid
     * options are json (default) and xml
     * @param string $dataType Data type
     * @return Grid
     */
    public function setDataType($dataType)
    {
        if(! ($dataType === 'xml' || $dataType === 'json'))
        {
            throw(new Exception('Invalid data type'));
        }

        $this->_dataType = $dataType;

        return $this;
    }

    /**
     * Specify the text to be displayed when there are no records to display.
     * This option is used only when viewrecords option is set to true. (default value is
     * set in language file)
     * @see Grid::setViewRecords
     * @param string $emptyRecords Display string
     * @return Grid
     */
    public function setEmptyRecords($emptyRecords)
    {
        $this->_emptyRecords = $emptyRecords;

        return $this;
    }

    /**
     * If set to true this will place a footer table with one row below the grid records
     * and above the pager. The number of columns equal to the number of columns in the colModel
     * (default: false)
     * @param boolean $footerRow indicating whether footerrow is displayed
     * @return Grid
     */
    public function setFooterRow($footerRow)
    {
        if (!is_bool($footerRow))
        {
            throw new Exception('footerRow is not a bool');
        }

        $this->_footerRow = ($footerRow === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * If set to true, when resizing the width of a column, the adjacent column (to the right)
     * will resize so that the overall grid width is maintained (e.g., reducing the width of
     * column 2 by 30px will increase the size of column 3 by 30px).
     * In this case there is no horizontal scrollbar.
     * Note: this option is not compatible with shrinkToFit option - i.e if
     * shrinkToFit is set to false, forceFit is ignored.
     * @param boolean $forceFit indicating if forcefit is enforced
     * @return Grid
     */
    public function setForceFit($forceFit)
    {
        if (!is_bool($forceFit))
        {
            throw new Exception('forceFit is not a bool');
        }

        $this->_forceFit = ($forceFit === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * In the previous versions of jqGrid including 3.4.X, reading relatively big data sets
     * (Rows >=100 ) caused speed problems. The reason for this was that as every cell was
     * inserted into the grid we applied about 5-6 jQuery calls to it. Now this problem has
     * been resolved; we now insert the entry row at once with a jQuery append. The result is
     * impressive - about 3-5 times faster. What will be the result if we insert all the
     * data at once? Yes, this can be done with help of the gridview option. When set to true,
     * the result is a grid that is 5 to 10 times faster. Of course when this option is set
     * to true we have some limitations. If set to true we can not use treeGrid, subGrid,
     * or afterInsertRow event. If you do not use these three options in the grid you can
     * set this option to true and enjoy the speed. (default: false)
     * @param boolean $gridView
     * @return Grid
     */
    public function setGridView($gridView)
    {
        if (!is_bool($gridView))
        {
            throw new Exception('gridView is not a bool');
        }

        $this->_gridView = ($gridView === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * If the option is set to true the title attribute is added to the column headers (default: false)
     * @param boolean $headerTitles indicating if headertitles are enabled
     * @return Grid
     */
    public function setHeaderTitles($headerTitles)
    {
        if (!is_bool($headerTitles))
        {
            throw new Exception('headerTitles is not a bool');
        }

        $this->_headerTitles = ($headerTitles === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * The height of the grid in pixels (default: 100%, which is the only acceptable percentage for jqGrid)
     * @param int $height Height in pixels
     * @return Grid
     */
    public function setHeight($height)
    {
        if (!ctype_digit((string) $height))
        {
            throw new Exception('Height is not an number');
        }

        $this->_height = $height;

        return $this;
    }

    /**
     * If set to true the grid initially is hidden. The data is not loaded (no request is sent) and only the
     * caption layer is shown. When the show/hide button is clicked for the first time to show the grid, the request
     * is sent to the server, the data is loaded, and the grid is shown. From this point on we have a regular grid.
     * This option has effect only if the caption property is not empty. (default: false)
     * @see Grid::setCaption()
     * @param boolean $hiddenGrid indicating if hiddengrid is enforced
     * @return Grid
     */
    public function setHiddenGrid($hiddenGrid)
    {
        if (!is_bool($hiddenGrid))
        {
            throw new Exception('hiddenGrid is not a bool');
        }

        $this->_hiddenGrid = ($hiddenGrid === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * Enables or disables the show/hide grid button, which appears on the right side of the caption layer.
     * Takes effect only if the caption property is not an empty string. (default: true)
     * @param boolean indicating if show/hide button is enabled
     * @return Grid
     */
    public function setHideGrid($hideGrid)
    {
        if (!is_bool($hideGrid))
        {
            throw new Exception('hideGrid is not a bool');
        }

        $this->_hideGrid = ($hideGrid === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * When set to false the mouse hovering is disabled in the grid data rows. (default: true)
     * @param boolean $hoverRows Indicates whether hoverrows is enabled
     * @return Grid
     */
    public function setHoverRows($hoverRows)
    {
        if (!is_bool($hoverRows))
        {
            throw new Exception('hoverRows is not a bool');
        }

        $this->_hoverRows = ($hoverRows === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * If this flag is set to true, the grid loads the data from the server only once (using the
     * appropriate datatype). After the first request the datatype parameter is automatically
     * changed to local and all further manipulations are done on the client side. The functions
     * of the pager (if present) are disabled. (default: false)
     * @param boolean $loadOnce indicating if loadonce is enforced
     * @return Grid
     */
    public function setLoadOnce($loadOnce)
    {
        if (!is_bool($loadOnce))
        {
            throw new Exception('loadOnce is not a bool');
        }

        $this->_loadOnce = ($loadOnce === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * The text which appears when requesting and sorting data. This parameter overrides the value in the language file.
     * @param string Loadtext
     * @return Grid
     */
    public function setLoadText($loadText)
    {
        $this->_loadText = $loadText;

        return $this;
    }

    /**
     * This option controls what to do when an ajax operation is in progress.
     * 'disable' - disables the jqGrid progress indicator. This way you can use your own indicator.
     * 'enable' (default) - enables ?Loading? message in the center of the grid.
     * 'block' - enables the ?Loading? message and blocks all actions in the grid until the ajax request
     * is finished. Note that this disables paging, sorting and all actions on toolbar, if any.
     * @param string $loadUi disable / enable / block
     * @return Grid
     */
    public function setLoadUi($loadUi)
    {
        if (!in_array($loadUi, array('block', 'enable', 'disable')))
        {
            throw new Exception('setLoadUi not valid');
        }

        $this->_loadUi = $loadUi;

        return $this;
    }

    /**
     * This parameter makes sense only when multiselect option is set to true.
     * Defines the key which must be pressed when making a multiselection. The possible values are:
     * 'shiftKey' - the user should press Shift Key
     * 'altKey' - the user should press Alt Key
     * 'ctrlKey' - the user should press Ctrl Key
     * @param string $multiKey Key to multiselect (shiftKey, altKey, ctrlKey)
     * @return Grid
     */
    public function setMultiKey($multiKey)
    {
        if (!in_array($multiKey, array('shiftKey', 'altKey', 'ctrlKey')))
        {
            throw new Exception('setMultiKey not valid');
        }

        $this->_multiKey = $multiKey;

        return $this;
    }

    /**
     * This option works only when multiselect = true. When multiselect is set to true, clicking anywhere
     * on a row selects that row; when multiboxonly is also set to true, the multiselection is done only
     * when the checkbox is clicked (Yahoo style). Clicking in any other row (suppose the checkbox is
     * not clicked) deselects all rows and the current row is selected. (default: false)
     * @param boolean $multiBoxOnly indicating if multiboxonly is enforced
     * @return Grid
     */
    public function setMultiBoxOnly($multiBoxOnly)
    {
        if (!is_bool($multiBoxOnly))
        {
            throw new Exception('multiBoxOnly is not a bool');
        }

        $this->_multiBoxOnly = ($multiBoxOnly === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * If this flag is set to true a multi selection of rows is enabled. A new column at the left side is added. Can be used with any datatype option. (default: false)
     * @param boolean $multiSelect indicating if multiselect is enabled
     * @return Grid
     */
    public function setMultiSelect($multiSelect)
    {
        if (!is_bool($multiSelect))
        {
            throw new Exception('multiSelect is not a bool');
        }

        $this->_multiSelect = ($multiSelect === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Determines the width of the multiselect column if multiselect is set to true. (default: 20)
    * @param string $multiSelectWidth width of the multiselect column
    * @return grid
    */
    public function setMultiSelectWidth($multiSelectWidth)
    {
        $this->_multiSelectWidth = $multiSelectWidth;

        return $this;
    }

    /**
     * Set the initially selected page number when loading data.
     * This parameter is passed to the url for use by the server routine retrieving the data (default: 1)
     * @param int $page Page number
     * @return Grid
     */
    public function setPage($page)
    {
        if (!ctype_digit((string) $page))
        {
				throw new Exception('Page not valid, not a digit');
        }

        $this->_page = $page;

        return $this;
    }

    /**
     * If pagername is specified a pagerelement is automatically added to the Grid
     * @param string $pager Id/name of pager
     * @return Grid
     */
    public function setPager($pager)
    {
        $this->_pager = $pager;

        return $this;
    }

    /**
     * Determines the position of the pager in the grid. By default the pager element
     * when created is divided in 3 parts (one part for pager, one part for navigator
     * buttons and one part for record information) (default: center)
     * @param string $pagerPos Position of pager (center, left, right)
     * @return Grid
     */
    public function setPagerPos($pagerPos)
    {
        if (!in_array($pagerPos, array('center', 'left', 'right')))
        {
            throw new Exception('pagerPos not valid');
        }

        $this->_pagerPos = $pagerPos;

        return $this;
    }

   /**
     * Determines if the pager buttons should be displayed if pager is available. Valid only if pager is set correctly. The buttons are placed in the pager bar. (default: true)
     * @param boolean $pgButtons indicating if pager buttons are displayed
     * @return Grid
     */
    public function setPgButtons($pgButtons)
    {
        if (!is_bool($pgButtons))
        {
            throw new Exception('pgButtons is not a bool');
        }

        $this->_pgButtons = ($pgButtons === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * Determines if the input box, where the user can change the number of the requested page, should be available. The input box appears in the pager bar. (default: true)
     * @param bool $pgInput indicating if pager input is available
     * @return Grid
     */
    public function setPgInput($pgInput)
    {
        if (!is_bool($pgInput))
        {
            throw new Exception('pgInput is not a bool');
        }
        $this->_pgInput = ($pgInput === true) ? 'true' : 'false';

        return $this;
    }

    /**
     * Show information about current page status. The first value is the current loaded page.
     * The second value is the total number of pages (default is set in language file)
     * Example: "Page {0} of {1}"
     * @param string $pgTextCurrent page status text
     * @return Grid
     */
    public function setPgText($pgText)
    {
        $this->_pgText = $pgText;

        return $this;
    }

   /**
    * Determines the position of the record information in the pager. Can be left, center, right
    * (default: right)
    * Warning: When pagerpos and recordpos are equally set, pager is hidden.
    * TODO: Check for equal pagerpos / recordpos settings when rendering.
    * @param string $recordPos Position of record information
    * @return Grid
    */
    public function setRecordPos($recordPos)
    {
        if (!in_array($recordPos, array('center', 'right', 'left')))
        {
            throw new Exception('setRecordPos not valid');
        }

        $this->_recordPos = $recordPos;

        return $this;
    }

   /**
    * Represent information that can be shown in the pager. This option is valid if viewrecords
    * option is set to true. This text appears only if the total number of records is greater then
    * zero.
    * In order to show or hide information the items between {} mean the following: {0} the
    * start position of the records depending on page number and number of requested records;
    * {1} - the end position {2} - total records returned from the data (default defined in language file)
    * @example "View {0} - {1} of {2}"
    * @param string $recordText Record Text
    * @return Grid
    */
    public function setRecordText($recordText)
    {
        $this->_recordText = $recordText;

        return $this;
    }

   /**
    * Defines the method of request to make (?POST? or ?GET?) (default: GET)
    * @param string $requestMethod request type (post or get)
    * @return Grid
    */
    public function setRequestMethod($requestMethod)
    {
        if (!in_array($requestMethod, array('post', 'get')))
        {
            throw new Exception('requestmethod not valid');
        }

        $this->_requestMethod = $requestMethod;

        return $this;
    }

    /**
    * Assigns a class to columns that are resizable so that we can show a resize
    * handle (default: empty string)
    * @param string $resizeClass
    * @return Grid
    */
    public function setResizeClass($resizeClass)
    {
        $this->_resizeClass = $resizeClass;

        return $this;
    }

   /**
    * Set the list of values displayed in the dropdown used to select the number of rows displayed.
    * When making a request, the value selected in the dropdown is passed as the rowNum
    * parameter. If set to an empty array, the dropdown will not appear in the pager.
    * Typically you can set this like [10,20,30]. If the rowNum parameter is set to
    * 30 then the selected value in the select box is 30.
    * @param array $rowList List of rows per page array(10,20,50)
    * @return Grid
    */
    public function setRowList(Array $rowList)
    {
        $this->_rowList = $rowList;

        return $this;
    }

   /**
    * Sets how many records we want to view in the grid. This parameter is passed to the url
    * for use by the server routine retrieving the data. Note that if you set this parameter
    * to 10 (i.e. retrieve 10 records) and your server return 15 then only 10 records will be
    * loaded. Set this parameter to -1 (unlimited) to disable this checking. (default: 20)
    *
    * NOTE: Using is_int($x) check instead of ctype_digit((string) $x), because in this case we DO want to allow
    * negative numbers to allow for the -1 case. Use ctype_digit only to enforce positive integers, like IDs.
    *
    * @param int $rowNum Number of rows per page
    * @return Grid
    */
    public function setRowNum($rowNum)
    {
        if (!is_int($rowNum))
        {
				throw new Exception('RowNum not valid, not a digit');
        }
        else if ($rowNum < -1)
        {
            throw new Exception('RowNum not valid, must be > -1');
        }

        $this->_rowNum = $rowNum;

        return $this;
    }

   /**
    * If this option is set to true, a new column at the leftside of the grid is added. The purpose of
    * this column is to count the number of available rows, beginning from 1. In this case
    * colModel is extended automatically with a new element with name - 'rn'. Also, be careful
    * not to use the name 'rn' in your colModel
    * @param boolean $rowNumbers Boolean indicating if rownumbers are enabled
    * @return Grid
    */
    public function setRowNumbers($rowNumbers)
    {
        if (!is_bool($rowNumbers))
        {
            throw new Exception('rowNumbers is not a bool');
        }

        $this->_rowNumbers = ($rowNumbers === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * Determines the width of the row number column if rownumbers option is set to true. (default: 25)
    * @param int $rowNumWidth Width of rownumbers column
    * @return Grid
    */
    public function setRowNumWidth($rowNumWidth)
    {
        if (!ctype_digit((string) $rowNumWidth))
        {
				throw new Exception('rowNumWidth not valid, not a digit');
        }

        $this->_rowNumWidth = $rowNumWidth;

        return $this;
    }

   /**
    * Creates dynamic scrolling grids. When enabled, the pager elements are disabled and we can use the
    * vertical scrollbar to load data. When set to true the grid will always hold all the items from the
    * start through to the latest point ever visited.
		* When scroll is set to an integer value (eg 1), the grid will just hold the visible lines. This allow us to
		* load the data at portions whitout to care about the memory leaks. (default: false)
    * @param boolean $scroll indicating if scroll is enforced
    * @return Grid
    */
    public function setScroll($scroll)
    {
        if (!is_bool($scroll))
        {
            throw new Exception('scroll is not a bool');
        }

        $this->_scroll = ($scroll === true) ? 'true' : 'false';

        $this->_scroll = $scroll;

        if ($this->_scrollInt)
        {
            throw new Exception("You can't set scroll to both a boolean and an integer at the same time, please choose one.");
        }

        return $this;
    }

   /**
    * Creates dynamic scrolling grids. When enabled, the pager elements are disabled and we can use the
	* vertical scrollbar to load data. When set to true the grid will always hold all the items from the
	* start through to the latest point ever visited.
	* When scroll is set to an integer value (eg 1), the grid will just hold the visible lines. This allow us to
	* load the data at portions whitout to care about the memory leaks. (default: false)
	* @see Grid::setScroll() for more details.
    * @param boolean $scrollWhen integer value is set (eg 1) scroll is enforced
    * @return Grid
    */
    public function setScrollInt($scroll)
    {
        if (!is_bool($scroll))
        {
            throw new Exception('scroll is not a bool');
        }

        $this->_scrollInt = ($scroll === true) ? 'true' : 'false';

        if ($this->_scroll)
        {
            throw new Exception("You can't set scroll to both a boolean and an integer at the same time, please choose one.");
        }

        return $this;
    }

   /**
    * Determines the width of the vertical scrollbar. Since different browsers interpret this width
    * differently (and it is difficult to calculate it in all browsers) this can be changed. (default: 18)
    * @param int $scrollOffset Width of the scrollbar is pixels
    * @return Grid
    */
    public function setScrollOffset($scrollOffset)
    {
        if (!ctype_digit((string) $scrollOffset))
        {
            throw new Exception('scrollOffset not valid, not a number');
        }

        $this->_scrollOffset = $scrollOffset;

        return $this;
    }

   /**
    * When enabled, selecting a row with setSelection scrolls the grid so that the selected row is visible.
    * This is especially useful when we have a vertical scrolling grid and we use form editing with
    * navigation buttons (next or previous row). On navigating to a hidden row, the grid scrolls so the
    * selected row becomes visible. (default: false)
    * @param boolean $scrollRows Boolean indicating if scrollrows is enabled
    * @return Grid
    */
    public function setScrollRows($scrollRows)
    {
        if (!is_bool($scrollRows))
        {
            throw new Exception('scrollRows is not a bool');
        }

        $this->_scrollRows = ($scrollRows === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * This controls the timeout handler when scroll is set to 1. (default: 200 milliseconds)
    * @param int $scrollTimeout Scroll timeout in milliseconds
    * @return Grid
    */
    public function setScrollTimeout($scrollTimeout)
    {
        if (!ctype_digit((string) $scrollTimeout))
        {
            throw new Exception('ScrollTimeout not a number');
        }

        $this->_scrollTimeout = $scrollTimeout;

        return $this;
    }

   /**
    * This option describes the type of calculation of the initial width of each column
    * against the width of the grid. If the value is true and the value in width option
    * is set then: Every column width is scaled according to the defined option width.
    * Example: if we define two columns with a width of 80 and 120 pixels, but want the
    * grid to have a 300 pixels - then the columns are recalculated as follow:
    * 1- column = 300(new width)/200(sum of all width)*80(column width) = 120 and 2 column = 300/200*120 = 180.
    * The grid width is 300px. If the value is false and the value in width option is set then:
    * The width of the grid is the width set in option.
    * The column width are not recalculated and have the values defined in colModel. (default: true)
    * @param boolean $shrinkToFit Boolean indicating if shrink to fit is enforced
    * @return Grid
    */
    public function setShrinkToFit($shrinkToFit)
    {
        if (!is_bool($shrinkToFit))
        {
            throw new Exception('shrinkToFit is not a bool');
        }

        $this->_shrinkToFit = ($shrinkToFit === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * Determines how the search should be applied. If this option is set to true search is started when
    * the user hits the enter key. If the option is false then the search is performed immediately after
    * the user presses some character. (default: true)
    * @param boolean $searchOnEnterI ndicates if search is started on enter
    * @return Grid
    */
    public function setSearchOnEnter($searchOnEnter)
    {
        if (!is_bool($searchOnEnter))
        {
            throw new Exception('searchOnEnter is not a bool');
        }

        $this->_searchOnEnter = ($searchOnEnter === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Enables toolbar searching / filtering
    * Toolbar searching/filtering creates a row of input fields below the grid headers.
    * @param boolean $searchToolbar Indicates if toolbar searching is enabled
    * @return Grid
    */
    public function setSearchToolbar($searchToolbar)
    {
        if (!is_bool($searchToolbar))
        {
            throw new Exception('searchToolbar is not a bool');
        }

        $this->_searchToolbar = ($searchToolbar === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * When set to true adds clear button to clear all search entries (default: false)
    * @param boolean $searchClearButton
    * @return Grid
    */
    public function setSearchClearButton($searchClearButton)
    {
        if (!is_bool($searchClearButton))
        {
            throw new Exception('searchClearButton is not a bool');
        }

        $this->_searchClearButton = ($searchClearButton === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * When set to true adds toggle button to toggle search toolbar (default: false)
    * @param boolean $searchToggleButton Indicates if toggle button is displayed
    * @return Grid
    */
    public function setSearchToggleButton($searchToggleButton)
    {
        if (!is_bool($searchToggleButton))
        {
            throw new Exception('searchToggleButton is not a bool');
        }

        $this->_searchToggleButton = ($searchToggleButton === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * If enabled all sort icons are visible for all columns which are sortable (default: false)
    * @param boolean $showAllSortIcons Boolean indicating if all sorting icons should be displayed
    * @return Grid
    */
    public function setShowAllSortIcons($showAllSortIcons)
    {
        if (!is_bool($showAllSortIcons))
        {
            throw new Exception('showAllSortIcons is not a bool');
        }

        $this->_showAllSortIcons = ($showAllSortIcons === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * Sets direction in which sort icons are displayed (default: vertical)
    * @param string $sortIconDirection Direction in which sort icons are displayed (vertical,horizontal)
    * @return Grid
    */
    public function setSortIconDirection($sortIconDirection)
    {
        if (!in_array($sortIconDirection, array('vertical', 'horizontal')))
        {
            throw new Exception('SortIconDirection not valid');
        }

        $this->_sortIconDirection = $sortIconDirection;

        return $this;
    }

   /**
    * If enabled columns are sorted when header is clicked (default: true)
    * Warning: if disabled and setShowAllSortIcons is set to false, sorting will
    * be effectively disabled
    * @param boolean $sortOnHeaderClick indicating if columns will sort on headerclick
    * @return Grid
    */
    public function setSortOnHeaderClick($sortOnHeaderClick)
    {
        if (!is_bool($sortOnHeaderClick))
        {
            throw new Exception('sortOnHeaderClick is not a bool');
        }

        $this->_sortOnHeaderClick = ($sortOnHeaderClick === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * The initial sorting name when we use datatypes xml or json (data returned from server).
    * This parameter is added to the url. If set and the value matches a name from the
    * colModel then by default an image sorting icon is added to the column, according to
    * the parameter sortorder.
    * @see Grid::setSortOrder()
    * @param string $sortName sort index
    * @return Grid
    */
    public function setSortName($sortName)
    {
        $this->_sortName = $sortName;

        return $this;
    }

   /**
    * The initial sorting order when we use datatypes xml or json (data returned from server).
    * This parameter is added to the url. Two possible values - asc or desc. (default: asc)
    * @param string $sortOrder Sort order (asc, desc)
    * @return Grid
    */
    public function setSortOrder($sortOrder)
    {
        if (!in_array($sortOrder, array('asc', 'desc')))
        {
            throw new Exception('Sorting order not valid');
        }

        $this->_sortOrder = $sortOrder;

        return $this;
    }

   /**
    * This option enabled the toolbar of the grid. When we have two toolbars (can be set using setToolbarPosition)
    * then two elements (div) are automatically created. The id of the top bar is constructed like
    * ?t_?+id of the grid and the bottom toolbar the id is ?tb_?+id of the grid. In case when
    * only one toolbar is created we have the id as ?t_? + id of the grid, independent of where
    * this toolbar is created (top or bottom). You can use jquery to add elements to the toolbars.
    * @param boolean $toolbar Boolean indicating if toolbar is enabled
    * @return Grid
    */
    public function setToolbar($toolbar)
    {
        if (!is_bool($toolbar))
        {
            throw new Exception('toolbar is not a bool');
        }

        $this->_toolbar = ($toolbar === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * Sets toolbar position (default: top)
    * @param string $toolbarPosition Position of toolbar (top, bottom, both)
    * @return Grid
    */
    public function setToolbarPosition($toolbarPosition)
    {
        if(!in_array($toolbarPosition, array('top', 'bottom', 'both'))) {
            throw new Exception('Invalid toolbar position');
        }
        $this->_toolbarPosition = $toolbarPosition;

        return $this;
    }

   /**
    * When enabled this option places a pager element at top of the grid, below the caption
    * (if available). If another pager is defined both can coexist and are refreshed in sync.
    * (default: false)
    * @param boolean $topPager indicating if toppager is enabled
    * @return Grid
    */
    public function setTopPager($topPager)
    {
        $this->_topPager = $topPager;

        return $this;
    }

   /**
    * The url of the file that handles the data request for this grild
    * @param string $url Data url
    * @return Grid
    */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

   /**
    * If true, jqGrid displays the beginning and ending record number in the grid,
    * out of the total number of records in the query.
    * This information is shown in the pager bar (bottom right by default) in this format:
    * ?View X to Y out of Z?.
    * If this value is true, there are other parameters that can be adjusted,
    * including 'emptyrecords' and 'recordtext'. (default: false)
    * @see Grid::setEmptyRecords()
    * @see Grid::setRecordText()
    * @param boolean $viewRecords Boolean indicating if recordnumbers are shown in grid
    * @return Grid
    */
    public function setViewRecords($viewRecords)
    {
        if (!is_bool($viewRecords))
        {
            throw new Exception('viewRecords is not a bool');
        }

        $this->_viewRecords = ($viewRecords === true) ? 'true' : 'false';

        return $this;
    }

   /**
    * If this option is not set, the width of the grid is a sum of the widths of the columns
    * defined in the colModel (in pixels). If this option is set, the initial width of each
    * column is set according to the value of shrinkToFit option.
    * @param int $widthWidth in pixels
    * @return Grid
    */
    public function setWidth($width)
    {
        if (!ctype_digit((string) $width))
        {
            throw new Exception('Width not a number');
        }

        $this->_width = $width;

        return $this;
    }

   /**
    * This event fires after each inserted row.
    * Variables available in call:
    * 'rowid': Id of the inserted row
    * 'rowdata': An array of the data to be inserted into the row. This is array of type name-
    * value, where the name is a name from colModel
    * 'rowelem': The element from the response. If the data is xml this is the xml element of the row;
    * if the data is json this is array containing all the data for the row
    * Note: this event does not fire if gridview option is set to true
    * @param string|JSFunction $onAfterInsertRow Script to be executed or function to be be passed in
    * @return Grid
    */
    public function onAfterInsertRow($onAfterInsertRow)
    {
        $this->_onAfterInsertRow = $onAfterInsertRow;

        return $this;
    }

   /**
    * This event fires before requesting any data. Does not fire if datatype is function
    * Variables available in call: None
    * @param string|JSFunction $onBeforeRequest Script to be executed
    * @return Grid
    */
    public function onBeforeRequest($onBeforeRequest)
    {
        $this->_onBeforeRequest = $onBeforeRequest;

        return $this;
    }

   /**
    * This event fires when the user clicks on the row, but before selecting it.
    * Variables available in call:
    * 'rowid': The id of the row.
    * 'e': The event object
    * This event should return boolean true or false. If the event returns true the selection
    * is done. If the event returns false the row is not selected and any other action if defined
    * does not occur.
    * @param string|JSFunction $onBeforeSelectRow Script to be executed
    * @return Grid
    */
    public function onBeforeSelectRow($onBeforeSelectRow)
    {
        $this->_onBeforeSelectRow = $onBeforeSelectRow;

        return $this;
    }

   /**
    * This fires after all the data is loaded into the grid and all the other processes are complete.
    * Also the event fires independent from the datatype parameter and after sorting paging and etc.
    * Variables available in call: None
    * @param string|JSFunction $onGridComplete Script to be executed
    * @return Grid
    */
    public function onGridComplete($onGridComplete)
    {
        $this->_onGridComplete = $onGridComplete;

        return $this;
    }

   /**
    * A pre-callback to modify the XMLHttpRequest object (xhr) before it is sent. Use this to set
    * custom headers etc. The XMLHttpRequest is passed as the only argument.
    * Variables available in call:
    * 'xhr': The XMLHttpRequest
    * @param string|JSFunction $onLoadBeforeSend Script to be executed
    * @return Grid
    */
    public function onLoadBeforeSend($onLoadBeforeSend)
    {
        $this->_onLoadBeforeSend = $onLoadBeforeSend;

        return $this;
    }

   /**
    * This event is executed immediately after every server request.
    * Variables available in call:
    * 'xhr': The XMLHttpRequest
    * @param string|JSFunction $onLoadComplete Script to be executed
    * @return Grid
    */
    public function onLoadComplete($onLoadComplete)
    {
        $this->_onLoadComplete = $onLoadComplete;

        return $this;
    }

   /**
    * A function to be called if the request fails.
    * Variables available in call:
    * 'xhr': The XMLHttpRequest
    * 'status': String describing the type of error
    * 'error': Optional exception object, if one occurred
    * @param string $onLoadError Script to be executed
    * @return Grid
    */
    public function onLoadError($onLoadError)
    {
        $this->_onLoadError = $onLoadError;

        return $this;
    }

   /**
    * Fires when we click on a particular cell in the grid.
    * Variables available in call:
    * 'rowid': The id of the row
    * 'iCol': The index of the cell,
    * 'cellcontent': The content of the cell,
    * 'e': The event object element where we click.
    * (Note that this available when we are not using cell editing module
    * and is disabled when using cell editing).
    * @param string|JSFunction $onCellSelect Script to be executed
    * @return Grid
    */
    public function onCellSelect($onCellSelect)
    {
        $this->_onCellSelect = $onCellSelect;

        return $this;
    }

   /**
    * Raised immediately after row was double clicked.
    * Variables available in call:
    * 'rowid': The id of the row,
    * 'iRow': The index of the row (do not mix this with the rowid),
    * 'iCol': The index of the cell.
    * 'e': The event object
    * @param string|JSFunction $onDblClickRow Script to be executed
    * @return Grid
    */
    public function onDblClickRow($onDblClickRow)
    {
        $this->_onDblClickRow = $onDblClickRow;

        return $this;
    }

   /**
    * Fires after clicking hide or show grid (hidegrid:true)
    * Variables available in call:
    * 'gridstate': The state of the grid - can have two values - visible or hidden
    * @param string|JSFunction $onHeaderClick Script to be executed
    * @retrun Grid
    */
    public function onHeaderClick($onHeaderClick)
    {
        $this->_onHeaderClick = $onHeaderClick;

        return $this;
    }

   /**
    * This event fires after click on [page button] and before populating the data.
    * Also works when the user enters a new page number in the page input box
    * (and presses [Enter]) and when the number of requested records is changed via
    * the select box.
    * If this event returns 'stop' the processing is stopped and you can define your
    * own custom paging
    * Variables available in call:
    * 'pgButton': first,last,prev,next in case of button click, records in case when
    * a number of requested rows is changed and user when the user change the number of the requested page
    * @param string|JSFunction $onPaging Script to be executed
    * @retrun Grid
    */
    public function onPaging($onPaging)
    {
        $this->_onPaging = $onPaging;

        return $this;
    }

   /**
    * Raised immediately after row was right clicked.
    * Variables available in call:
    * 'rowid': The id of the row,
    * 'iRow': The index of the row (do not mix this with the rowid),
    * 'iCol': The index of the cell.
    * 'e': The event object
    * Note - this event does not work in Opera browsers, since Opera does not support oncontextmenu event
    * @param string|JSFunction $onRightClickRow Script to be executed
    * @return Grid
    */
    public function onRightClickRow($onRightClickRow)
    {
        $this->_onRightClickRow = $onRightClickRow;

        return $this;
    }

   /**
    * This event fires when multiselect option is true and you click on the header checkbox.
    * Variables available in call:
    * 'aRowids':  Array of the selected rows (rowid's).
    * 'status': Boolean variable determining the status of the header check box - true if checked, false if not checked.
    * Note that the aRowids alway contain the ids when header checkbox is checked or unchecked.
    * @param string|JSFunction $onSelectAll Script to be executed
    * @return Grid
    */
    public function onSelectAll($onSelectAll)
    {
        $this->_onSelectAll = $onSelectAll;

        return $this;
    }

   /**
    * Raised immediately when row is clicked.
    * Variables available in function call:
    * 'rowid': The id of the row,
    * 'status': Tthe status of the selection. Can be used when multiselect is set to true.
    * true if the row is selected, false if the row is deselected.
    * @param string|JSFunction $onSelectRowScript to be executed
    * @return Grid
    */
    public function onSelectRow($onSelectRow)
    {
        $this->_onSelectRow = $onSelectRow;

        return $this;
    }


   /**
    * Raised immediately after sortable column was clicked and before sorting the data.
    * Variables available in call:
    * 'index': The index name from colModel
    * 'iCol': The index of column,
    * 'sortorder': The new sorting order - can be 'asc' or 'desc'.
    * If this event returns 'stop' the sort processing is stopped and you can define your own custom sorting
    * @param string|JSFunction $onSortColScript to be executed
    * @return Grid
    */
    public function onSortCol($onSortCol)
    {
        $this->_onSortCol = $onSortCol;

        return $this;
    }

   /**
    * Event which is called when we start resizing a column.
    * Variables available in call:
    * 'event':  The event object
    * 'index': The index of the column in colModel.
    * @param string|JSFunction $onResizeStartScript to be executed
    * @return Grid
    */
    public function onResizeStart($onResizeStart)
    {
        $this->_onResizeStart = $onResizeStart;
        return $this;
    }

   /**
    * Event which is called after the column is resized.
    * Variables available in call:
    * 'newwidth': The new width of the column
    * 'index': The index of the column in colModel.
    * @param string $onResizeStopScript to be executed
    * @return Grid
    */
    public function onResizeStop($onResizeStop)
    {
        $this->_onResizeStop = $onResizeStop;

        return $this;
    }

   /**
    * If this event is set it can serialize the data passed to the ajax request.
    * The function should return the serialized data. This event can be used when
    * custom data should be passed to the server - e.g - JSON string, XML string and etc.
    * Variables available in call:
    * 'postData': Posted data
    * @param string|JSFunction $onSerializeGridDataScript to be executed
    * @return Grid
    */
    public function onSerializeGridData($onSerializeGridData)
    {
        $this->_onSerializeGridData = $onSerializeGridData;

        return $this;
    }

   /**
    * Creates and returns javascript + required html elements to render grid
    */
    public function __ToString()
    {
        // ensure we have the datafeed url
        if (!$this->_url)
        {
            throw new Exception('No url set use ->setUrl(parameter) to set the url');
        }

        // ensure we have at least one column
        if (!is_array($this->_columns) || count($this->_columns) == 0)
        {
            throw new Exception('No columns set, use ->addColumn(Column::create("parameter")) to add column');
        }

        // Create javascript
        $Script = '';

        // Start script
        $Script .= '<script type="text/javascript">';
        $Script .= 'jQuery(document).ready(function () {';
        $Script .= "jQuery('#" . $this->_id . "').jqGrid({";

        // Altrows
        if ($this->_altRows) $Script .= "altRows: " . $this->_altRows . "," . "\n";

        // Altclass
        if ($this->_altClass) $Script .= "altclass: '" . $this->_altClass . "'," . "\n";

        // Autoencode
        if ($this->_autoEncode) $Script .= "autoencode: " . $this->_autoEncode . "," . "\n";

        // Autowidth
        if ($this->_autoWidth) $Script .= "autowidth: " . $this->_autoWidth . "," . "\n";

        // Caption
        if ($this->_caption) $Script .= "caption: '" . $this->_caption . "'," . "\n";

        // Datatype
        $Script .= "datatype: '" . $this->_dataType . "' ," . "\n";

        if ($this->_dataType === 'json')
        {
            $Script .= "jsonReader: {repeatitems: false, id: '" . $this->_JsonReader['id'] . "'} ," . "\n";
        }

        // Emptyrecords
        if ($this->_emptyRecords) $Script .= "emptyrecords: '" . $this->_emptyRecords . "'," . "\n";

        // FooterRow
        if ($this->_footerRow) $Script .= "footerrow: " . $this->_footerRow ."," . "\n";

        // Forcefit
        if ($this->_forceFit) $Script .= "forceFit: " . $this->_forceFit . "," . "\n";

        // Gridview
        if ($this->_gridView) $Script .= "gridview: " . $this->_gridView . "," . "\n";

        // HeaderTitles
        if ($this->_headerTitles) $Script .= "headertitles: " . $this->_headerTitles . "," . "\n";

        // Height (set 100% if no value is specified except when scroll is set to true otherwise layout is not as it is supposed to be)
        if (!$this->_height)
        {
            if ((!$this->_scroll || $this->_scroll == 'false') && !$this->_scrollInt) $Script .= "height: '100%'," . "\n";
        }
        else $Script .= "height: " . $this->_height . "," . "\n";;

        // Hiddengrid
        if ($this->_hiddenGrid) $Script .= "hiddengrid: " . $this->_hiddenGrid . "," . "\n";

        // Hidegrid
        if ($this->_hideGrid) $Script .= "hidegrid: " . $this->_hideGrid . "," . "\n";

        // HoverRows
        if ($this->_hoverRows) $Script .= "hoverrows: " . $this->_hoverRows . "," . "\n";

        // Loadonce
        if ($this->_loadOnce) $Script .= "loadonce: " . $this->_loadOnce . "," . "\n";

        // Loadtext
        if ($this->_loadText) $Script .= "loadtext: '" . $this->_loadText . "'," . "\n";

        // LoadUi
        if ($this->_loadUi) $Script .= "loadui: '" . $this->_loadUi . "'," . "\n";

        // MultiBoxOnly
        if ($this->_multiBoxOnly) $Script .= "multiboxonly: " . $this->_multiBoxOnly ."," . "\n";;

        // MultiKey
        if ($this->_multiKey) $Script .= "multikey: '" . $this->_multiKey . "'," . "\n";

        // MultiSelect
        if ($this->_multiSelect) $Script .= "multiselect: " . $this->_multiSelect . "," . "\n";

        // MultiSelectWidth
        if ($this->_multiSelectWidth) $Script .= "multiselectWidth: " . $this->_multiSelectWidth . ",". "\n";

        // Page
        if ($this->_page) $Script .= "page: " . $this->_page .",". "\n";

        // Pager
        if ($this->_pager) $Script .= "pager:'#" . $this->_pager . "',". "\n";

        // PagerPos
        if ($this->_pagerPos) $Script .= "pagerpos: '" . $this->_pagerPos. "',". "\n";

        // PgButtons
        if ($this->_pgButtons) $Script .= "pgbuttons: " . $this->_pgButtons .",". "\n";

        // PgInput
        if ($this->_pgInput) $Script .= "pginput: " . $this->_pgInput .",". "\n";

        // PGText
        if ($this->_pgText) $Script .= "pgtext: '" . $this->_pgText ."',". "\n";

        // RecordPos
        if ($this->_recordPos) $Script .= "recordpos: '" . $this->_recordPos . "',". "\n";

        // RecordText
        if ($this->_recordText) $Script .= "recordtext: '" . $this->_recordText . "',". "\n";

        // Request Type
        if ($this->_requestMethod) $Script .= "mtype: '" . $this->_requestMethod . "',". "\n";

        // ResizeClass
        if ($this->_resizeClass) $Script .= "resizeclass: '" . $this->_resizeClass ."',". "\n";

        // Rowlist
        if ($this->_rowList != null) $Script .= "rowList: [" . implode(',', $this->_rowList) . "],". "\n";

        // Rownum
        if ($this->_rowNum) $Script .= "rowNum: " . $this->_rowNum .",". "\n";

        // Rownumbers
        if ($this->_rowNumbers) $Script .= "rownumbers: " . $this->_rowNumbers . ",". "\n";

        // RowNumWidth
        if ($this->_rowNumWidth) $Script .= "rownumWidth: " . $this->_rowNumWidth .",". "\n";

        // Scroll (setters make sure either scroll or scrollint is set, never both)
        if ($this->_scroll) $Script .= "scroll: " . $this->_scroll .",". "\n";
        if ($this->_scrollInt) $Script .= "scroll: " . $this->_scrollInt .",". "\n";

        // ScrollOffset
        if ($this->_scrollOffset) $Script .= "scrollOffset: " . $this->_scrollOffset .",". "\n";

        // ScrollRows
        if ($this->_scrollRows) $Script .= "scrollrows: " . $this->_scrollRows .",". "\n";

        // ScrollTimeout
        if ($this->_scrollTimeout) $Script .= "scrollTimeout: " . $this->_scrollTimeout . ",". "\n";

        // Sortname
        if ($this->_sortName) $Script .= "sortname: '" . $this->_sortName . "',". "\n";

        // Sorticons
        if ($this->_showAllSortIcons || $this->_sortIconDirection || $this->_sortOnHeaderClick)
        {
            // Set defaults
            if (!$this->_showAllSortIcons)
            {
                $this->_showAllSortIcons = 'false';
            }

            if (!$this->_sortIconDirection) $this->_sortIconDirection = 'vertical';

            if ($this->_sortOnHeaderClick === null)
            {
                $this->_sortOnHeaderClick = 'true';
            }

            $Script .= "viewsortcols: [" . $this->_showAllSortIcons . ",'" .  $this->_sortIconDirection . "', " . $this->_sortOnHeaderClick . "],". "\n";
        }

        // Shrink to fit
        if ($this->_shrinkToFit) $Script .= "shrinkToFit: " . $this->_shrinkToFit . ",". "\n";

        // Sortorder
        if ($this->_sortOrder) $Script .= "sortorder: '" . $this->_sortOrder . "',". "\n";

        // Toolbar
        if ($this->_toolbar) $Script .= "toolbar: [" . $this->_toolbar .", '" . $this->_toolbarPosition . "'],". "\n";

        // Toppager
        if ($this->_topPager) $Script .= "toppager: " . $this->_topPager .",". "\n";

        // Url
        if ($this->_url) $Script .= "url: '" . $this->_url ."',". "\n";

        // View records
        if ($this->_viewRecords) $Script .= "viewrecords: " . $this->_viewRecords .",". "\n";

        // Width
        if ($this->_width) $Script .= "width:'" . $this->_width ."',". "\n";

        $Script .= $this->outputEvent('afterInsertRow',     array('rowid','rowdata', 'rowelem'));
        $Script .= $this->outputEvent('beforeRequest',      array());
        $Script .= $this->outputEvent('beforeSelectRow',    array('rowid','e'));
        $Script .= $this->outputEvent('gridComplete',       array());
        $Script .= $this->outputEvent('loadBeforeSend',     array('xhr'));
        $Script .= $this->outputEvent('loadComplete',       array('xhr'));
        $Script .= $this->outputEvent('loadError',          array('xhr', 'status', 'error'));
        $Script .= $this->outputEvent('cellSelect',         array('rowid','iCol', 'cellcontent', 'e'));
        $Script .= $this->outputEvent('dblClickRow',        array('rowid','iRow', 'iCol', 'e'));
        $Script .= $this->outputEvent('headerClick',        array('gridstate'));
        $Script .= $this->outputEvent('paging',             array('pgButton'));
        $Script .= $this->outputEvent('rightClickRow',      array('rowid','iRow', 'iCol', 'e'));
        $Script .= $this->outputEvent('selectAll',          array('aRowIds', 'status'));
        $Script .= $this->outputEvent('selectRow',          array('rowid','status'));
        $Script .= $this->outputEvent('sortCol',            array('index','iCol', 'sortorder'));
        $Script .= $this->outputEvent('resizeStart',        array('event', 'index'));
        $Script .= $this->outputEvent('resizeStop',         array('newwidth','index'));
        $Script .= $this->outputEvent('serializeGridData',  array('postData'));

        // Colmodel
        $Script .= "colModel: [". "\n";

        $ColModels = array();

        /* @var $column Column */
        foreach ($this->_columns as $column)
        {
            $ColModels[] = $column->__ToString();
        }

           $Script .= implode(" ,\n", $ColModels) . "\n";

        $Script .= "]". "\n";

        // End jqGrid call
        $Script .= "});". "\n";

        // Search clear button
        if ($this->_searchToolbar == 'true' && $this->_searchClearButton && $this->_pager && $this->_searchClearButton == 'true')
        {
            $Script .= "jQuery('#" . $this->_id . "').jqGrid('navGrid',\"#" . $this->_pager . "\",{edit:false,add:false,del:false,search:false,refresh:false}); ";
			$Script .= "jQuery('#" . $this->_id . "').jqGrid('navButtonAdd',\"#" . $this->_pager . "\",{caption:\"Clear\",title:\"Clear Search\",buttonicon :'ui-icon-refresh', onClickButton:function(){jQuery('#" . $this->_id . "')[0].clearToolbar(); }}); ";
        }

        // Search toolbar
        if ($this->_searchToolbar == 'true')
        {
            $Script .= "jQuery('#" . $this->_id . "').jqGrid('filterToolbar', {stringResult:true";
            if ($this->_searchOnEnter) $Script .= ", searchOnEnter: " . $this->_searchOnEnter;
            $Script .= "});";
        }

        // End script
        $Script .= "});";
        $Script .= "</script>";

        // Create table which is used to render grid
        // Note: Table element is created with empty row, as HTML4/XHTML state that table may not be empty.
        $Table = '';
        $Table .= '<table id="' . $this->_id . '"><tr><td /></tr></table>';

        // Create pager element if is set
        $Pager = '';
        if ($this->_pager)
        {
            $Pager .= '<div id="' . $this->_pager . '"></div>';
        }

        // Create toppager element if is set
        $TopPager = '';
        if ($this->_topPager == 'true')
        {
            $TopPager .= '<div id="' . $this->_id . '_toppager\</div>';
        }

        // Insert grid id where needed (in columns)
        $Script = str_replace("##gridid##", $this->_id, $Script);

        // Return script + required elements
        return $Script . $Table . $Pager . $TopPager;
    }

    function outputEvent($eventName, array $params = array()) {
        $output = '';
        $attributeName = '_on'.ucfirst($eventName);
        if($this->$attributeName) {

            $event = $this->$attributeName;

            if($event instanceof JSFunction) {
                $output .= "{$eventName}: {$event}, \n";
            } else {
                $params = implode($params, ", ");
                $output .= "on".ucfirst($eventName).": function({$params}) { {$event} }, \n";
            }
        }

        return $output;
    }
}

class Column
{
    private $_align;
    private $_classes = array();
    private $_columnName;
    private $_firstSortOrder;
    private $_fixedWidth;
    private $_formatter = array();
    private $_customFormatter;
    private $_index;
    private $_hidden;
    private $_key;
    private $_label;
    private $_resizeable;
    private $_search;
    private $_searchType;
    private $_searchTerms;
    private $_searchDateFormat;
    private $_sortable;
    private $_title;
    private $_width;

    /**
    * Constructor
    * @param string $columnNameName of column, cannot be blank or set to 'subgrid', 'cb', and 'rn'
    */
    private function __construct($columnName)
    {
        // Make sure columnname is not left blank
        if (trim($columnName) === '')
        {
            throw new Exception("No columnname specified");
        }

        // Make sure columnname is not part of the reserved names collection
        $reservedNames = array("subgrid", "cb", "rn");

        if (in_array($columnName, $reservedNames))
        {
            throw new Exception("Columnname '" + $columnName + "' is reserved");
        }

        // Set columnname
        $this->_columnName = $columnName;

        // Set index equal to columnname by default, can be overriden by setter
        $this->_index = $columnName;
    }

    /**
     * Creates new instance of column
     * @param string $columnName  of column, cannot be blank or set to 'subgrid', 'cb', and 'rn'
     * @return Column
     */
    public static function create($columnName)
    {
        return new Column($columnName);
    }

  /**
    * This option allow to add a class to to every cell on that column. In the grid css
    * there is a predefined class ui-ellipsis which allow to attach ellipsis to a
    * particular row. Also this will work in FireFox too.
    * Multiple calls to this function are allowed to set multiple classes
    * @param sring $className Classname
    * @return Column
    */
    public function addClass($className)
    {
        $this->_classes[] = $className;

        return $this;
    }

  /**
    * Set dateformat of datepicker when searchtype is set to datepicker (default: dd-mm-yy)
    * @param string $searchDateFormat Dateformat dateformat of datepicker
    * @return Column
    */
    public function setSearchDateFormat($searchDateFormat)
    {
        $this->_searchDateFormat = $searchDateFormat;

        return $this;
    }

  /**
    * Set searchterms if search type of this column is set to type select
    * @param array $searchTerms Searchterm to add to dropdownlist
    * @return Column
    */
    public function setSearchTerms(Array $searchTerms)
    {
        $this->_searchTerms = $searchTerms;

        return $this;
    }

  /**
    * Defines the alignment of the cell in the Body layer, not in header cell.
    * Possible values: left, center, right. (default: left)
    * @param string $align Alignment of column (center, right, left
    * @return Column
    */
    public function setAlign($align)
    {
        if (!in_array($align, array('center', 'right', 'left')))
        {
            throw new Exception('Align not valid');
        }

        $this->_align = $align;

        return $this;
    }

  /**
    * If set to asc or desc, the column will be sorted in that direction on first
    * sort.Subsequent sorts of the column will toggle as usual (default: null)
    * @param string $firstSortOrder First sort order
    * @return Column
    */
    public function setFirstSortOrder($firstSortOrder)
    {
        $this->_firstSortOrder = $firstSortOrder;

        return $this;
    }

  /**
    * If set to true this option does not allow recalculation of the width of the
    * column if shrinkToFit option is set to true. Also the width does not change
    * if a setGridWidth method is used to change the grid width. (default: false)
    * @param boolean $fixedWidth Indicates if width of column is fixed
    * @retrun Column
    */
    public function setFixed($fixedWidth)
    {
        if (!is_bool($fixedWidth))
        {
            throw new Exception('fixedWidth is not a bool');
        }

        $this->_fixedWidth = ($fixedWidth === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Sets formatter with default formatoptions (as set in language file)
    * Default formatters are: number, currency, date, email, link, showlink, checkbox and select
    * @param string $formatter Formatter
    * @param array $formatOptions format options
    * @return Column
    */
    public function setFormatter($formatter, array $formatOptions = null)
    {
        if ($this->_customFormatter)
        {
            throw new Exception("You cannot set a formatter and a customformatter at the same time, please choose one.");
        }

        $defaultFormatters = array( 'integer',
                'number',
                'currency',
                'date',
                'email',
                'link',
                'showlink',
                'checkbox',
                'select');

        if (!in_array($formatter, $defaultFormatters))
        {
            throw new Exception("Formatter " . $formatter . " is not an default Formatter");
        }

        $this->_formatter = array('formatter' => $formatter, 'formatterOptions' => $formatOptions);

        return $this;
    }

    /**
    * Sets custom formatter. Usually this is a function. When set in the formatter option
    * this should not be enclosed in quotes and not entered with () -
    * just specify the name of the function
    * The following variables are passed to the function:
    * 'cellvalue': The value to be formated (pure text).
    * 'options': Object { rowId: rid, colModel: cm} where rowId - is the id of the row colModel is
    * the object of the properties for this column getted from colModel array of jqGrid
    * 'rowobject': Row data represented in the format determined from datatype option.
    * If we have datatype: xml/xmlstring - the rowObject is xml node,provided according to the rules
    * from xmlReader If we have datatype: json/jsonstring - the rowObject is array, provided according to
    * the rules from jsonReader
    * @param string $customFormatter
    * @return Column
    */
    public function setCustomFormatter($customFormatter)
    {
        if ($this->_formatter)
        {
            throw new Exception("You cannot set a formatter and a customformatter at the same time, please choose one.");
        }
        $this->_customFormatter = $customFormatter;

        return $this;
    }

    /**
    * Defines if this column is hidden at initialization. (default: false)
    * @param boolean $hidden indicating if column is hidden
    * @return Column
    */
    public function setHidden($hidden)
    {
        if (!is_bool($hidden))
        {
            throw new Exception('hidden is not a bool');
        }

        $this->_hidden = ($hidden === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Set the index name when sorting. Passed as sidx parameter. (default: Same as columnname)
    * @param string $indexName of index
    * @return Column
    */
    public function setIndex($index)
    {
        $this->_index = $index;

        return $this;
    }

    /**
    * In case if there is no id from server, this can be set as as id for the unique row id.
    * Only one column can have this property. If there are more than one key the grid finds
    * the first one and the second is ignored. (default: false)
    * @param boolean $keyIndicates if key is set
    * @return Column
    */
    public function setKey($key)
    {
        if (!is_bool($key))
        {
            throw new Exception('key is not a bool');
        }

        $this->_key = ($key === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Defines the heading for this column. If empty, the heading for this column comes from the name property.
    * @param string $label Label name of column
    * @return Column
    */
    public function setLabel($label)
    {
        $this->_label = $label;

        return $this;
    }

    /**
    * Defines if the column can be resized (default: true)
    * @param boolean $resizeable Indicates if the column is resizable
    * @return Column
    */
    public function setResizeable($resizeable)
    {
        if (!is_bool($resizeable))
        {
            throw new Exception('resizeable is not a bool');
        }

        $this->_resizeable = ($resizeable === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * When used in search modules, disables or enables searching on that column. (default: true)
    * @param boolean $search Indicates if searching for this column is enabled
    * @return Column
    */
    public function setSearch($search)
    {
        if (!is_bool($search))
        {
            throw new Exception('search is not a bool');
        }

        $this->_search = ($search === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * Sets the searchtype of this column (text, select or datepicker) (default: text)
    * Note: To use datepicker jQueryUI javascript should be included
    * @param string $search TypeSearch type
    * @return Column
    */
    public function setSearchType($searchType)
    {
        if (!in_array($searchType, array('text', 'select', 'datepicker')))
        {
            throw new Exception('Search type not valid');
        }

        $this->_searchType = $searchType;

        return $this;
    }

    /**
    * Indicates if column is sortable (default: true)
    * @param boolean $sortable Indicates if column is sortable
    * @return Column
    */
    public function setSortable($sortable)
    {
        if (!is_bool($sortable))
        {
            throw new Exception('sortable is not a bool');
        }

        $this->_sortable = ($sortable === true) ? 'true' : 'false';

        return $this;
    }

    /**
    * If this option is false the title is not displayed in that column when we hover over a cell (default: true)
    * @param string $title Indicates if title is displayed when hovering over cell
    * @return Column
    */
    public function setTitle($title)
    {
        $this->_title = $title;

        return $this;
    }

    /**
    * Set the initial width of the column, in pixels. This value currently can not be set as percentage (default: 150)
    * @param int $widthWidth in pixels
    * @return Column
    */
    public function setWidth($width)
    {
        if (!ctype_digit((string) $width))
        {
			throw new Exception('Width not valid, not a digit');
        }

        $this->_width = $width;

        return $this;
    }

    /**
    * Creates javascript string from column to be included in grid javascript
    */
    public function __ToString()
    {
        $Script = '';

        // Start column
        $Script .= "{";

        // Align
        if ($this->_align) $Script .= "align: '" . $this->_align . "', ";

        // Classes
        if (count($this->_classes) > 0) $Script .= "classes: '" . implode(' ', $this->_classes) ."', ";

        // Columnname
        $Script .= "name: '" . $this->_columnName . "',";

        // FirstSortOrder
        if ($this->_firstSortOrder) $Script .= "firstsortorder: '" . $this->_firstSortOrder  . "', ";

        // FixedWidth
        if ($this->_fixedWidth) $Script .= "fixed: " . $this->_fixedWidth  . ",";

        // Formatters
        if (isset($this->_formatter['formatter']))
        {
            $Script .= "formatter: '" . $this->_formatter['formatter']  . "', ";

            if (($this->_formatter['formatter']) && is_array($this->_formatter['formatterOptions']))
            {
                $formatOptions = array();

                foreach ($this->_formatter['formatterOptions'] as $key => $value)
                {
                    $formatOptions[] = $key . ":'" . $value . "'";
                }

                $Script .= "formatoptions: {" . implode(',', $formatOptions) . "} , ";
            }
        }

        // Custom formatter
        if ($this->_customFormatter) $Script .= "formatter: " .  $this->_customFormatter . ", ";

        // Hidden
        if ($this->_hidden) $Script .= "hidden: " . $this->_hidden . ", ";

        // Key
        if ($this->_key) $Script .= "key: " . $this->_key . ", ";

        // Label
        if ($this->_label) $Script .= "label: '" . $this->_label . "', ";

        // Resizable
        if ($this->_resizeable) $Script .= "resizable: " . $this->_resizeable . ", ";

        // Search
        if ($this->_search) $Script .= "search: " . $this->_search . ", ";

        // SearchType
        if ($this->_searchType)
        {
            if ($this->_searchType == 'text') $Script .= "stype:'text', ";
            if ($this->_searchType == 'select') $Script .= "stype:'select', ";
        }

        // Searchoptions
        if ($this->_searchType == 'select' || $this->_searchType == 'datepicker')
        {
            $Script .= "searchoptions: {";

            // Searchtype select
            if ($this->_searchType == 'select')
            {
               if ($this->_searchTerms != null)
               {
                       $options = '';

                       if (count($this->_searchTerms) > 0)
                       {
                           $tempoptions = array();

                           foreach ($this->_searchTerms AS $key => $value)
                           {

                               $tempoptions[] = $key . ':' . $value;
                           }

                           $options = implode(';', $tempoptions);
                       }

                    $Script .= "value: ':;" . $options . "'" ;
                   }
                   else
                   {
                    $Script .= "value: ':'";
                }
            }

            // Searchtype datepicker
            if ($this->_searchType == 'datepicker')
            {
                if (!$this->_searchDateFormat)
                    $Script .= 'dataInit:function(el){$(el).datepicker({changeYear:true, onSelect: function() {var sgrid = $(\'###gridid##\')[0]; sgrid.triggerToolbar();},dateFormat:\'dd-mm-yy\'});}';
                else
                    $Script .= 'dataInit:function(el){$(el).datepicker({changeYear:true, onSelect: function() {var sgrid = $(\'###gridid##\')[0]; sgrid.triggerToolbar();},dateFormat:\'' . $this->_searchDateFormat . '\'});}';
            }

            $Script .= "}, ";
        }

        // Sortable
        if ($this->_sortable) $Script .= "sortable: " . $this->_sortable  . ", ";

        // Title
        if ($this->_title) $Script .= "title: '" . $this->_title  . "', ";

        // Width
        if ($this->_width) $Script .= "width: " . $this->_width  . ", ";

        // Index
        $Script .= "index: '" . $this->_index  . "' ";;

        // End column
        $Script .= "}";

        return $Script;
    }
}

class JSFunction {
    private $name;
    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return (string) $this->name;
    }
}


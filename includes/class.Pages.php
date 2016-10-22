<?php
/* Класс для разбивки по страницам */

	class Pages {
		var $rowsPerPage;	// Количество элементов на странице
		var $numRows;		// Общее количество элементов
		var $currentPage;	// Текущая страница
		var $pageVarName;	// Имя переменной PAGE
		var $pagesRegion;	// Диапазон отображения страниц
		
		// CSS Стили
		var $styleTitle   = 'pages_title';
		var $stylePage    = 'pages_link';
		var $styleCurrent = 'pages_current';
		var $styleArrows  = 'pages_arrows';

		// HTML шаблоны
		var $tplHeader = '';
		var $tplFooter = '';
		
		// Конструктор
		function Pages($numRows = 30, $rowsPerPage = 3, $pageVarName = 'page') {
			$this->numRows = $numRows;
			$this->rowsPerPage = $rowsPerPage;
			$this->pageVarName = $pageVarName;
			if (!isset($GLOBALS['_GET'][$pageVarName])) {
				$this->currentPage = 1;
			} else {
				if ($GLOBALS['_GET'][$pageVarName] <= 0 || $GLOBALS['_GET'][$pageVarName] > $this->getPagesCount()) {
					$this->currentPage = 1;
				} else {
					$this->currentPage = $GLOBALS['_GET'][$pageVarName];
				}
			}
			
			$this->pagesRegion = 3;
		}

		// Возвращает количество строк на страницу
		function getRowsPerPage() {
			return $this->rowsPerPage;
		}

		// Возвращает количество строк
		function getNumRows() {
			return $this->numRows;
		}

		// Возвращает текущую страницу
		function getCurrentPage() {
			if (isset($GLOBALS['_GET'][$this->pageVarName]))
				$this->currentPage = $GLOBALS['_GET'][$this->pageVarName];
			else $this->currentPage = 1;
			
			return $this->currentPage;
		}

		// Возвращает количество страниц
		function getPagesCount() {
			$result = $this->numRows / $this->rowsPerPage;
			if ($result != floor($result)) $result++;
			$result = floor($result);
			return $result;
		}

		// Возвращает минимальную строку
		function getMinRow($page = '') {
			if (!$page) $page = $this->currentPage;
			return ($this->rowsPerPage*($page-1) + 1);
		}

		// Возвращает максимальную строку
		function getMaxRow($page = '') {
			if (!$page)	$page = $this->currentPage;
			if (($maxRow = $this->getMinRow($page) + $this->rowsPerPage - 1) > $this->numRows)
				return $this->numRows;
			else
				return $maxRow;
		}

		// Возвращает следующую страницу
		function getNextPage($page = '') {
			if (!$page) $page = $this->currentPage;
			if ($page < $this->getPagesCount())
				return $page + 1;
			else
				return $this->getPagesCount();
		}

		// Возвращает предыдущую страницу
		function getPrevPage($page = '') {
			if (!$page)	$page = $this->currentPage;
			if ($page > 1)
				return $page - 1;
			else
				return 1;
		}

		// Возвращает диапазон для SQL функции LIMIT
		function getLimit($page = '') {
			$this->currentPage = $this->getCurrentPage();
			return ($this->getMinRow($this->currentPage)-1 . ", " . $this->rowsPerPage);
		}

		// Возвращает диапазон для SQL функции LIMIT
		function getRealLimit($page = '') {
			$this->currentPage = $this->getCurrentPage();
			if ((($this->getMinRow($this->currentPage)-1)+ $this->rowsPerPage ) > $this->numRows )
				return ($this->getMinRow($this->currentPage)-1 . ", " . ($this->numRows-($this->getMinRow($this->currentPage)-1)));
			else
				return ($this->getMinRow($this->currentPage)-1 . ", " . $this->rowsPerPage);
		}

		// Производит генерацию строки, навигации по страницам
		function getPageLinks($href) {
			if (($pagesCount = $this->getPagesCount()) > 1) {
				$str = '';
				
				if (($startPage = $this->currentPage - $this->pagesRegion) < 1)	$startPage = 1;
				if (($endPage = $this->currentPage + $this->pagesRegion) > $pagesCount) $endPage = $pagesCount;
				
				for ($i = $startPage; $i <= $endPage; $i++) {
					if ($i == $this->currentPage) $str.= '<span class="'.$this->styleCurrent.'">'.$i.'</span>';
					else $str.= $this->getPageLink($i, $i, $href);
				}
				
				// Первая страница
				//$str = '<a href="'.str_replace("{PAGE}", 1, $href).'" class="'.$class.'">первая</a>'.$str;
				
				// Влево
				if (($this->currentPage > 1) && ($this->currentPage <= $pagesCount+1)) {
					$page_num = $this->currentPage - 1;
					$str = '<a href="'.str_replace("{PAGE}", $page_num, $href).'" class="'.$this->styleArrows.'">&laquo;</a>'.$str;
				}
				
				// Вправо
				if ($this->currentPage < $pagesCount) {
					$page_num = $this->currentPage + 1;
					$str.= '<a href="'.str_replace("{PAGE}", $page_num, $href).'" class="'.$this->styleArrows.'">&raquo;</a>';
				}
				
				// Последняя страница
				//$str = $str.'<a href="'.str_replace("{PAGE}", $pagesCount, $href).'" class="'.$class.'">последняя</a>';
				
				return $str;
			} else {
				return '';
			}
		}

		// Возвращает ссылку на страницу
		function getPageLink($page, $title, $href) {
			return '<a href="'.str_replace("{PAGE}", $page, $href).'" class="'.$this->stylePage.'">'.$title.'</a>';
		}

		// Возвращает номер первой и последней строки, а также общее количество
		function getRowsInfo($page = '') {
			if (!$page)
				$page = $currentPage;
			return $this->getMinRow($page) . " - " . $this->getMaxRow($page) . " / " . $this->numRows;
		}

		// Возвращает номер текущей страницы и общее количество страниц
		function getPagesInfo($page = '') {
			if (!$page)
				$page = $currentPage;
			return $currentPage . " / " . $this->getPagesCount();
		}

		// Возвращает URL сформированный из массива параметров
		function getParamUrl($param_array) {
			$url = '';
			while (list($key, $val) = each($param_array)) {
				$url.= '&'.$key.'='.$val;
			}
			return $url;
		}

		// Производит парсинг готовой навигации по страницам в метку [ $assign_to ]
		function parse($url, $title = '', $assign_to = 'PAGES') {
			global $tpl;
			
			if (empty($url)) $url = $_SERVER['PHP_SELF'].'?page_id='.PAGE_ID.'&lang='.LANG_ID.'&page={PAGE}';
			
			if ($this->getPagesCount() > 1) {
				if (!empty($title)) {
					$view = '<span class="'.$this->styleTitle.'">'.$title.":</span>&nbsp;".$this->getPageLinks($url);
				} else {
					$view = $this->getPageLinks($url);
				}
				
				$view = $this->tplHeader.$view.$this->tplFooter;
				$tpl->assign($assign_to, $view);
			} else { 
				$tpl->assign($assign_to, "");
			}
		}
	}
?>
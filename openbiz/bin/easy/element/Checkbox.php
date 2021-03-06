<?PHP
/**
 * PHPOpenBiz Framework
 *
 * LICENSE
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @package   openbiz.bin.easy.element
 * @copyright Copyright &copy; 2005-2009, Rocky Swen
 * @license   http://www.opensource.org/licenses/bsd-license.php
 * @link      http://www.phpopenbiz.org/
 * @version   $Id$
 */

include_once("OptionElement.php");

/**
 * Checkbox class is element for Checkbox
 *
 * @package openbiz.bin.easy.element
 * @author Rocky Swen
 * @copyright Copyright (c) 2005-2009
 * @access public
 */
class Checkbox extends OptionElement
{
    /**
     * Get value of element
     *
     * @return mixed
     */
    public function getValue()
    {
        if($this->m_Value)
        {
            return $this->m_Value;
        }
        else
        {
            return $this->m_DefaultValue;
        }
    }

    /**
     * Render element, according to the mode
     *
     * @return string HTML text
     */
    public function render()
    {
        $boolValue = $this->getSelectFrom();
        $disabledStr = ($this->getEnabled() == "N") ? "DISABLED=\"true\"" : "";
        $checkedStr = ($boolValue == $this->m_Value) ? "CHECKED" : "";
        $style = $this->getStyle();
        $text = $this->getText();
        $func = $this->getFunction();
        $sHTML = '';
        $fromList = array();
        $this->getFromList($fromList);
        
        if (count($fromList) > 1)
        {
            $valueArr = explode(',', $this->m_Value);

            foreach ($fromList as $opt)
            {
                $test = array_search($opt['val'], $valueArr);
                if ($test === false)
                {
                    $checkedStr = '';
                }
                else
                {
                    $checkedStr = "CHECKED";
                }
                $sHTML .= "<INPUT TYPE=CHECKBOX NAME='".$this->m_Name."[]' ID=\"" . $this->m_Name ."\" VALUE=\"" . $opt['val'] . "\" $checkedStr $disabledStr $this->m_HTMLAttr $func /> " . $opt['txt'] . "";
            }
        }
        else
        {
            $sHTML = "<INPUT TYPE=\"CHECKBOX\" NAME=\"" . $this->m_Name . "\" ID=\"" . $this->m_Name ."\" VALUE='$boolValue' $checkedStr $disabledStr $this->m_HTMLAttr $style $func /> ".$text."";
        }

        return $sHTML;
    }
}

?>

<?php

/**
 * Class ThemeFilter
 */
class ThemeFilter extends CApplicationComponent
{
    /**
     * @param $paramName
     * @param $value
     * @param CHttpRequest $request
     * @return bool
     */
    public function isMainSearchParamChecked($paramName, $value, CHttpRequest $request)
    {
        $data = $request->getQuery($paramName);

        return !empty($data) && in_array($value, $data);
    }
}

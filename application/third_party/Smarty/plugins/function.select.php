<?php
/**
 * Third Party Smarty plugin
 */
function smarty_function_select( $params, &$smarty )
{
    $values = $params['value'];
    $selected = $params['selected'];
    $multiple = $params['multiple'];

    $object      = $values[0]->object;
    $object_id   = $values[0]->object_id;
    $object_name = $values[0]->object_name;

    if ($multiple)
    {
        $to_return = "<select name='select_$object". '[]' ."' id='select_$object'>"
        . "<option value='0'>-- Select one --</option>";
    }
    else{
        $to_return = "<select name='select_$object' id='select_$object'>"
        . "<option value='0'>-- Select one --</option>";
    }

    
    foreach($values as $value)
    {
        if ($selected == $value->$object_id)
        {
            $to_return .= "<option selected='selected' value='{$value->$object_id}'>{$value->$object_name}</option>";
        }
        else
        {
            $to_return .= "<option value='{$value->$object_id}'>{$value->$object_name}</option>";
        }
    }

    $to_return .= "</select>";

    return $to_return;
}

?>

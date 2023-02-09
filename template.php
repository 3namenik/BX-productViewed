<?
$viewed_ids_full = ProductViewed::get();
$viewed_ids = [];
foreach ($viewed_ids_full as $key => $value) {
    if ($arResult['ID'] != $key) {
        $viewed_ids[] = $key;
    }
}
if (!empty($viewed_ids)) {
    global $ViewedFilter;
    $ViewedFilter = [
        'ID' => $viewed_ids
    ];
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "slider_items",
        array(
            "FILTER_NAME" => 'ViewedFilter',
        ),
        $component
    );
}
?>

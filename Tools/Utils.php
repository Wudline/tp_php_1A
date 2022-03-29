<?php

    namespace Tools;

    class Utils
    {
        public $rslt;

        public function ResultRequest($db, $request, $msgNullCmpt, $msgNullExec)
        {
            $this->rslt = NULL;

            $stmt = $db->prepare($request);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();

            if ( $exec )
            {
                if ( $cmpt>0 )
                {
                    $this->rslt = $stmt->fetchAll();
                }
                else
                {
                    $this->rslt = $msgNullCmpt;
                }
            }
            else
            {
                $this->rslt = $msgNullExec;
            }

            return $this->rslt;
        }
    }

?>
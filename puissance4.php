<?php
    include_once ("plateau.php");

    class puissance4
    {
        //proprietes
        private $plateau;
        private $joueur;

        //methodes
        function __construct()
        {
            $this->plateau = new plateau();
            $this->joueur = 0;
        }

        public function reset()
        {
            
            $this->plateau->resetPlateau();
            $this->joueur = 0;
        }
        public function play($column)
        {
            $result = $this->plateau->play($this->joueur + 1, $column);
            if ($result == 0)
            {
                $this->joueur = ($this->joueur)? 0: 1;
                return ($this->getHTML());
            }
            else if ($result == 1)
                return ("<div class='win'>player ".$this->joueur." win</div><br/>");
            else if ($result == 2)
                return ("<div class='equal'>nobody win</div><br/>");
            else
                return ($this->failHTML($result));
        }

        public function getHTML()
        {
            $plateauHTML = $this->plateau->getPlateauHtml();
            $player = $this->joueur+1;
            return ("<div class='nextplayer'>It's player ".$player." to play please select one column</div><br/>".$plateauHTML);
        }

        private function failHTML($result)
        {
            if ($result < 0)
                return ("<div class='error'>there is some error in puissance4 code please email me at jleu@student.42.fr for report it</div>");
            $plateauHTML = $this->plateau->getPlateauHtml();
            if ($result == 6)
                return ("<div class='fail'>this column is full please make an other move</div><br/>".$plateauHTML);
        }
    }
?>
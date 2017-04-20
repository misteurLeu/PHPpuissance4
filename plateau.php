<?php
class plateau
{
    //proprietes
    private $plateau = array();

    //methodes
    function __construct()
    {
        $this->resetPlateau();
    }

    public function resetPlateau()
    {
        for ($i = 0; $i < 6; $i++)
            for ($j = 0; $j < 7; $j++)
                $this->plateau[$i][$j] = 0;
    }

    public function     play($player, $column)
    {
        //if ($player != 1 || $player != 2 || $column < 0 || $column > 6)
        //    return -1;
        $line = $this->poserjeton($player, $column);
        if ($line < 0 || $line > 5)
            return $line;
        return ($this->verifposition($line, $column, $player));
    }

    public function getPlateauHtml()
    {
        $html = "<div class='plateau'>";
        for ($i = 0; $i < 6; $i++)
            for ($j = 0; $j < 7; $j++)
                $html .= "<div class='line".$i." column".$j." player".$this->plateau[$i][$j]." celule' onclick='play(".$j.")'></div>";
        $html.="</div>";
        return ($html);
    }

    private function poserjeton($player, $column)
    {
      //  if ($player != 1 || $player != 2 || $column < 0 || $column > 6)
      //      return -1;
        for ($cptpos = 0; $cptpos < 6; $cptpos++)
        {
            if ($this->plateau[$cptpos][$column] == 0)
            {
                $this->plateau[$cptpos][$column] = $player;
                return ($cptpos);
            }
        }
        return ($cptpos);
    }

    private function verifposition($line, $column, $player)
    {
     //   if ($player != 1 || $player != 2 || $column < 0 || $column > 6 || $line < 0 || $line > 5)
     //      return -1;
        if ($this->verifline($line, $player) || $this->verifcolumn($column, $player) || $this->verifdiago($line, $column, $player))
            return 1;
        else if ($this->veriffull())
            return 2;
        else
            return 0;
    }

    private function verifline($line, $player)
    {
        $cptpos = -1;
        $cptwin = 0;
        while (++$cptpos < 7 && $cptwin < 4)
        {
            if ($this->plateau[$line][$cptpos] == $player)
                $cptwin++;
            else
                $cptwin = 0;
        }
        if ($cptwin == 4)
            return 1;
        return 0;
    }

    private function verifcolumn($column, $player)
    {
        $cptpos = -1;
        $cptwin = 0;
        while (++$cptpos < 6 && $cptwin < 4)
        {
            if ($this->plateau[$cptpos][$column] == $player)
                $cptwin++;
            else
                $cptwin = 0;
        }
        if ($cptwin == 4)
            return 1;
        else
            return 0;
    }

    private function verifdiago($line, $column, $player)
    {
        $cptline = $line;
        $cptcolumn = $column;
        while ($cptline > 0 && $cptcolumn > 0)
        {
            $cptline--;
            $cptcolumn--;
        }
        $cptwin = 0;
        while ($cptline < 6 && $cptcolumn < 7 && $cptwin < 4)
        {
            if ($this->plateau[$cptline][$cptcolumn] == $player)
                $cptwin++;
            else
                $cptwin = 0;
            $cptline++;
            $cptcolumn++;
        }
        if ($cptwin == 4)
            return 1;
        $cptline = $line;
        $cptcolumn = $column;
        while ($cptline > 0 && $cptcolumn < 6)
        {
            $cptline--;
            $cptcolumn++;
        }
        $cptwin = 0;
        while ($cptline < 6 && $cptcolumn >= 0 && $cptwin < 4)
        {
            if ($this->plateau[$cptline][$cptcolumn] == $player)
                $cptwin++;
            else
                $cptwin = 0;
            $cptline++;
            $cptcolumn--;
        }
        if ($cptwin == 4)
            return 1;
        return 0;
    }

    private function veriffull()
    {
        for ($i = 0; $i < 6; $i++)
            for ($j = 0; $j < 7; $j++)
                if ($this->plateau[$i][$j] == 0)
                    return 0;
        return (1);
    }
}
?>
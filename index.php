<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"
    </head>
    <body>
        <?php
            $name = 'Jim';
            $what = 'geek';
            $level = 10;
            echo 'Hi, my name is '.$name,', and I am a level '.$level.'
            '.$what;
            echo '<br/>';
            $hoursworked = $_GET['hours'];
            $rate = 12;
            $total = $hoursworked * $rate;
            if ($hoursworked > 40) {
                $total = $hoursworked * $rate * 1.5;
            } else {
                $total = $hoursworked * $rate;
            }
            echo ($total > 0) ? 'You owe me '.$total : "You're welcome";
            
            
            echo '<br/>';
            
            class Game{
                function __construct($squares) {
                    $this->position = str_split($squares);
                }
                
                function winner($token) {
                    $won = false;
                    if (($this->position[0] == $token) &&
                    ($this->position[1] == $token) &&
                    ($this->position[2] == $token)) {
                        $won = true;
                    } else if (($this->position[3] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[5] == $token)) {
                        $won = true;
                    } else if (($this->position[6] == $token) &&
                    ($this->position[7] == $token) &&
                    ($this->position[8] == $token)) {
                        $won = true;
                    } else if (($this->position[0] == $token) &&
                    ($this->position[3] == $token) &&
                    ($this->position[6] == $token)) {
                        $won = true;
                    } else if (($this->position[1] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[7] == $token)) {
                        $won = true;
                    } else if (($this->position[2] == $token) &&
                    ($this->position[5] == $token) &&
                    ($this->position[8] == $token)) {
                        $won = true;
                    } else if (($this->position[0] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[8] == $token)) {
                        $won = true;
                    } else if (($this->position[2] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)) {
                        $won = true;
                    }
                    return $won;
                }
                
                function display() {
                    echo '<table cols=”3” style=”fontsize:
                    large; fontweight:
                    bold”>';
                    echo '<tr>'; // open the first row
                    for ($pos=0; $pos<9;$pos++) {
                        echo '<td>-</td>';
                        if ($pos %3 == 2) {
                            echo '</tr><tr>'; // start a new row for the next square
                        }
                    }
                    echo '</tr>'; // close the last row
                    echo '</table>';
                }
            }
            
            $game = new Game($squares);
            $game->display();
            if ($game->winner('x')) {
                echo 'You win. Lucky guesses!';
            } else if ($game->winner('o')) {
                echo 'I win. Muahahahaha';
            } else {
                echo 'No winner yet, but you are losing.';
            }
            
        ?>
        
    </body>
</html>

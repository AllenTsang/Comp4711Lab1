<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"
    </head>
    <body>
        <?php
            /**
             * CLASS: Game
             * 
             * Contains the logic required to create the game.
             */
            class Game{
                var $position, $gameover;
                
                /**
                 * FUNCTION: __construct
                 * 
                 * Constructor for the Game class.
                 * 
                 * @param string $squares   Represents the current board.
                 */
                function __construct($squares) {
                    if($squares == '') {
                        $squares = '---------';
                    }
                    $this->position = str_split($squares);
                    $this->gameover = false;
                }
                
                /**
                 * FUNCTION: winner
                 * 
                 * Determines whether a given player has won the game.
                 * 
                 * @param type $token   Represents a player's pieces.
                 * @return boolean      Whether the player specified won.
                 */
                function winner($token) {
                    //row check
                    for($row=0; $row<3; $row++) {
                        if (($this->position[3*$row] == $token) 
                        && ($this->position[3*$row+1] == $token)
                        && ($this->position[3*$row+2] == $token)) {
                            $this->gameover = true;
                            return true;
                        }
                    }
                    //column check
                    for($col=0; $col<3; $col++) {
                        if (($this->position[$col] == $token)
                        && ($this->position[$col+3] == $token)
                        && ($this->position[$col+6] == $token)) {
                            $this->gameover = true;
                            return true;
                        }
                    }
                    //diagonal checks
                    if ((($this->position[0] == $token) && ($this->position[4] == $token)
                    && ($this->position[8] == $token)) || (($this->position[2] == $token)
                    && ($this->position[4] == $token) && ($this->position[6] == $token))) {
                        $this->gameover = true;
                        return true;
                    }
                    return false;
                }
                
                /**
                 * FUNCTION: display
                 * 
                 * Draws the current board.
                 */
                function display() {
                    echo '<table cols=”3” style=”font-size: large; font-weight: bold”>';
                    echo '<tr>'; // open the first row
                    for ($pos=0; $pos<9; $pos++) {
                        echo $this->show_cell($pos);
                        if ($pos %3 == 2) {
                            echo '</tr><tr>'; // start a new row for the next square
                        }
                    }
                    echo '</tr>'; // close the last row
                    echo '</table>';
                }
                
                /**
                 * FUNCTION: show_cell
                 * 
                 * Generates the HTML string to draw the cell requested.
                 * 
                 * @param type $which   The index of the cell to be drawn.
                 * @return type         Contents of the cell.
                 */
                function show_cell($which) {
                    $token = $this->position[$which];
                    // deal with the easy case
                    if ($token <> '-') {
                        return '<td>'.$token.'</td>';
                    }
                    // now the hard case
                    $this->newposition = $this->position; // copy the original
                    $this->newposition[$which] = 'x'; // this would be their move
                    $move = implode($this->newposition); // make a string from the board array
                    $link = './?board='.$move; // this is what we want the link to be
                    // so return a cell containing an anchor and showing a hyphen
                    if($this->gameover == true) {
                        return '<td>-</td>';
                    }
                    return '<td><a href="'.$link.'">-</a></td>';
                }
                
                /**
                 * FUNCTION: pick_move
                 * 
                 * Selects a move for the AI (by choosing the first open slot).
                 */
                function pick_move() {
                    for($pos=0; $pos < 9; $pos++) {
                        if($this->position[$pos] == '-') {
                            $this->position[$pos] = 'o';
                            break;
                        }
                    }
                }
            }
            
            //create the game
            $game = new Game($_GET['board']);
            //check if player won
            if ($game->winner('x')) {
                echo 'You win. Lucky guesses!';
            } else {
                //pick a move for the AI
                $game->pick_move();
                //check if AI won
                if ($game->winner('o')) {
                    echo 'I win. Muahahahaha';
                } else {
                    echo 'No winner yet, but you are losing.';
                }
            }
            //display the board
            $game->display();
            //link to restart game
            echo '<br/><a href="./?board=---------">Restart game</a>';
        ?>
        
    </body>
</html>

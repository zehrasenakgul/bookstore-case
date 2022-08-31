<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\User;
use App\Notifications\QuoteNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class DailyQuote extends Command {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'quote:daily';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'At the end of the day, notification of the added books to the manager via e-mail';

    /**
    * Create a new command instance.
    *
    * @return void
    */

    public function __construct() {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return int
    */

    public function handle() {

        // Mail::send( 'email.books', [ 'data' => $books ], function( $mail ) use ( $user ) {
        //     $mail->from( 'bookstore@moneo.com', 'Moneo' );
        //     $mail->to( $user->email )->subject( 'Daily new Quote!' );
        // }

        $books = Book::whereDay( 'created_at', '=', now()->day )
        ->with( 'translation' )
        ->orderBy( 'id', 'asc' )
        ->get();

        $userSchema = User::where( 'id', 1 )->first();

        $array = array();

        foreach ( $books as $value ) {
            $array[] = $value->translation[ 0 ]->name ;
        }

        $quoteData = [
            'greeting' => 'Merhaba '.$userSchema->name.',',
            'body' => 'Bugün eklenen kitaplar:',
            'list' =>  $array,
            'thanks' => 'Thank you this is from codeanddeploy.com',
        ];

        Notification::send( $userSchema->email, new QuoteNotification( $quoteData ) );
        $this->info( 'Books added today were reported to the manager via e-mail.' );

    }

}

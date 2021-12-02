<?php

use Illuminate\Database\Migrations\Migration;

class CreateJsonExtractFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::unprepared('
        CREATE FUNCTION `json_extract`(
        details TEXT,
        required_field VARCHAR (255)
        ) RETURNS TEXT CHARSET latin1
        BEGIN
        SET details = SUBSTRING_INDEX(details, "{", -1);
        SET details = SUBSTRING_INDEX(details, "}", 1);
        RETURN TRIM(
            BOTH \'"\' FROM SUBSTRING_INDEX(
                SUBSTRING_INDEX(
                    SUBSTRING_INDEX(
                        details,
                        CONCAT(
                            \'"\',
                            SUBSTRING_INDEX(required_field,\'$.\', -1),
                            \'":\'
                        ),
                        -1
                    ),
                    \',"\',
                    1
                ),
                \':\',
                -1
            )
        ) ;
        END
        ');
        } catch (Exception $e) {
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}

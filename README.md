PHP_DateTime
============

Extra functionality for PHP's DateTime class

<table>
    <tr>
        <td>
            <h6>__construct([String datetime [, Array working_days [, Array holidays]]])</h6>
            datetime is a datetime string in sql datetime format (YYYY-mm-dd HH:mm:ss) Default null<br />
            <h6>__construct([Integer timestamp [, Array working_days [, Array holidays]]])</h6>
            timestamp is a unix timestamp integer Default null<br />
            <br />
            <i>If no datetime or timestamp is given then the date and time of the server at the instance of the<br />
            object will be used. If $GLOBALS['dbh'] holds a valid database handle and a defined var of USE_DATABASE_TME              is set to 'True' then the database time of 'now()' will be used.</i><br />
            <br />
            working_days is an array of numbers:
            <table>
                <tr>
                    <td>1: Monday</td>
                </tr>
                <tr>
                    <td>2: Tuesday</td>
                </tr>
                <tr>
                    <td>3: Wednesday</td>
                </tr>
                <tr>
                    <td>4: Thursday</td>
                </tr>
                <tr>
                    <td>5: Friday</td>
                </tr>
                <tr>
                    <td>6: Saturday</td>
                </tr>
                <tr>
                    <td>7: Sunday</td>
                </tr>
            </table>
            working_days default null<br />
            holidays is an array of datetime strings in sql datetime format (YYYY-mm-dd HH:mm:ss) Default null
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            <h6>add_working_days(Integer days_to_add [, Array working_days [, Array holidays [, String returns]]])</h6>
            Use working_days and holidays to change the respective arrays set in the construct. Both default null.<br />
            returns is a string to format the datetime returned. Default null.<br />
            if returns is set then method will return a datetime string of format given<br />
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            <h6>minus_working_days(Integer days_to_add [, Array working_days [, Array holidays [, String returns]]])</h6>
            use working_days and holidays to change the respective arrays set in the construct. Both default null.<br />
            returns is a string to format the datetime returned. Default null.<br />
            if returns is set then method will return a datetime string of format given<br />
        </td>
    </tr>
</table>

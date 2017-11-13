<h1>Plane ID: {id}</h1>
<br />
<br />
<br />
<br />
<br />
<form role="form" action="/fleet/submit" method="post">
    {hid}    
    {fmanufacturer}
    {fmodel}
    {fprice}
    {fseats}
    {freach}
    {fcruise}
    {ftakeoff}
    {fhourly}
    <br/>
    {zsubmit}
    <a href="/fleet/cancel"><input type="button" value="Cancel the current edit"/></a>
    <a href="/fleet/delete"><input type="button" value="Delete this Plane"/></a>  
</form>
    {error}
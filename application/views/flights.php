{pagetitle}

<div class="tables">
    <table>        
        <thead>
            <tr>
               <th>Flight Number</th>
               <th>Departure Airport</th>
               <th>Arrival Airport</th>
            </tr>
        </thead>        
        <tbody>
            {flights}
            <tr title="Plane: {Plane ID}
                Depart: {Departure time} Arrive: {Arrival time}">
                <td><a href="fleet/show/{PlaneID}">{id}</a></td>
                <td>{DepartureAirport}</td>
                <td>{ArrivalAirport}</td>
            </tr>
            {/flights}
        </tbody>
    </table>
</div>
<br/>
<br/>
{add}
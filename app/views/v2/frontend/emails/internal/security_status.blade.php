<?php

$today_date = date('j,n,Y');
?>

<h1>Please Read this E-mail Daily</h1>

<h1>{{ $today_date }}</h1>

<h2>Gateway Failure Report</h2>
<p>All Count Gateway Count: {{ $gateway_log['all_count'] }}</p>
<p>Gateway Failure Count: {{ $gateway_log['fail_count'] }}</p>


<h2>IP Ban</h2>
<p>Number of IP banned: {{ $ip_ban['ban_count'] }}</p>
<p>Banned IPs: </p>
<ul>
@foreach($ip_ban['ips'] as $ip)
	<li>{{ $ip['ip'] }}</li>

@endforeach

</ul>

<h2>Login Failures</h2>
<p>Login Failures Count: {{ $login_failures['login_failures_count'] }}</p>

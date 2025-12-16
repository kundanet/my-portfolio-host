<h2>New Contact Form Message</h2>

<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Message:</strong></p>

<p>{{ $data['message'] }}</p>

<hr>

<p>Sent on: {{ now()->format('d M Y H:i A') }}</p>

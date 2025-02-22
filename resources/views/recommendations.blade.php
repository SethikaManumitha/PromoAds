<!DOCTYPE html>
<html>

<head>
    <title>Shop Recommendations</title>
</head>

<body>
    <h1>Recommended Shops</h1>

    @forelse ($recommendedShops as $shop)
    <ul>
        <li>{{ $shop['business_name'] }} (Similarity Score: {{ $shop['similarity_score'] }})</li>
    </ul>
    @empty
    <p>No recommendations available.</p>
    @endforelse

</body>

</html>
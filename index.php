<?php
$states = [
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware',
    'DC' => 'District Of Columbia',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming',
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Address Validator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="padding-top: 40px; background-color: lightgray">
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Address Validator</h5>
      <h6 class="card-subtitle mb-2 text-muted">Validate/Standardizes addresses using USPS</h6>
      <hr/>
      <form id="addressValidate">
        <div class="mb-3">
          <label for="addressLine1">Address Line 1</label>
          <input type="text" class="form-control" id="addressLine1" name="addressLine1"
                 placeholder="Enter Address Line 1">
        </div>
        <div class="mb-3">
          <label for="addressLine2">Address Line 2</label>
          <input type="text" class="form-control" id="addressLine2" name="addressLine2"
                 placeholder="Enter Address Line 2">
        </div>
        <div class="mb-3">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
        </div>
        <div class="mb-3">
          <label for="state">State</label>
          <select class="form-control" id="state" name="state">
            <?php foreach ($states as $code => $state) { ?>
              <option value="<?php echo $code; ?>"><?php echo $state; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="zip">Zip Code</label>
          <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter Zip Code">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Validate</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Save Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <p>Which address format do you want to save?</p>
          <div class="btn-group text-uppercase">
            <input type="radio" name="type" class="btn-check" id="original" autocomplete="off" value="original">
            <label class="btn btn-primary" for="original" id="switchToOriginal">Original</label>
            <input type="radio" name="type" class="btn-check" id="usps" autocomplete="off" checked value="standardized">
            <label class="btn btn-primary" for="usps" id="switchToStandardized">Standardized (USPS)</label>
          </div>
        </div>
        <div class="mb-3">
          <textarea class="form-control" id="addressPreview" rows="5" readonly></textarea>
        </div>
        <div class="alert alert-success visually-hidden" role="alert" id="successAlert">
          Address saved successfully!
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveButton">Save</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
<script src="js/index.js"></script>
</body>
</html>

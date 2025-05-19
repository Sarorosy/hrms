<div class="flex justify-end my-2 mr-10"><button id="download-pdf" class=" mt-4 bg-blue-700 text-white py-2 px-4 rounded flex items-center"><i class="fas fa-download" ></i>Save as PDF</button></div>
<div class="w-full max-w-4xl mx-auto bg-white p-2 rounded-xl hover:shadow:lg mt-5 border-top-blue pdf-content">
    
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 border-b">
    <div>
      <h1 class="text-2xl font-bold">Payslip</h1>
      <p class="text-muted-foreground"><?php echo strdate($payslips['date']) ?></p>
    </div>
    <div class="flex items-center mt-4 sm:mt-0">
      <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 flex items-center justify-center text-gray-500 font-bold">
        <img src="<?php echo base_url('assets/images/vda-logo.png') ?>" alt="Employee logo" class="rounded-full" />
      </div>
      <div>
        <h2 class="font-semibold">EMPLOYEE Pvt. Ltd.</h2>
        <p class="text-sm text-muted-foreground">10 CSC, Xyz Street, XYZ Nagar, XYZ</p>
        <p class="text-sm text-muted-foreground">Chennai-600012</p>
      </div>
    </div>
  </div>
  
  <div class="space-y-6 p-4">
    <div class="bg-blue-500 text-white p-2">
      <h3 class="text-lg">Employee Details</h3>
    </div>
    <table class="min-w-full border">
      <tbody>
        <tr>
          <td class="font-medium border p-2">Name</td>
          <td class="border p-2"><?php echo $employee['name'] ?></td>
          <td class="font-medium border p-2">Emp Code</td>
          <td class="border p-2"><?php echo $employee['employee_id'] ?></td>
        </tr>
        <tr>
          <td class="font-medium border p-2">Work Position</td>
          <td class="border p-2"><?php if($employee['role'] == "HR") {echo "Human Resources" ; } else if($employee['role'] == "ADMIN"){echo "Manager" ; } else{echo getPositionById($employee['position']);} ?></td>
            <td class="font-medium border p-2">Aadhar No.</td>
          <td class="border p-2"><?php echo $employee['aadharno'] ?></td>
        </tr>
        <tr>
          <td class="font-medium border p-2">PAN No.</td>
          <td class="border p-2"><?php echo $employee['pancard'] ?></td>
          <td class="font-medium border p-2">UAN No.</td>
          <td class="border p-2"><?php echo $employee['uanno'] ?></td>
        </tr>
        <tr>
          <td class="font-medium border p-2">ESIC No.</td>
          <td class="border p-2">-</td>
          <td class="font-medium border p-2">Joining Date</td>
          <td class="border p-2"><?php echo strdate($employee['joining_date']) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="grid gap-6 md:grid-cols-2">
      <div>
        <div class="bg-blue-500 text-white p-2">
          <h3 class="text-lg">Payment & Leave Details</h3>
        </div>
        <table class="min-w-full border">
          <tbody>
            <tr>
              <td class="font-medium border p-2">Bank Name</td>
              <td class="border p-2"><?php echo $employee['bankname'] ?></td>
            </tr>
            <tr>
              <td class="font-medium border p-2">Account No</td>
              <td class="border p-2"><?php echo $employee['account_no'] ?></td>
            </tr>
            <tr>
              <td class="font-medium border p-2">IFSC Code</td>
              <td class="border p-2"><?php echo $employee['ifsc_code'] ?></td>
            </tr>
            <tr>
              <td class="font-medium border p-2">Unpaid Leave</td>
              <td class="border p-2"><?php echo $payslips['unpaid_leave_days'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div>
        <div class="bg-blue-500 text-white p-2">
          <h3 class="text-lg">Location Details</h3>
        </div>
        <table class="min-w-full border">
          <tbody>
            <tr>
              <td class="font-medium border p-2">Head Office</td>
              <td class="border p-2">Chennai</td>
            </tr>
            <tr>
              <td class="font-medium border p-2">Branch Office</td>
              <td class="border p-2">XYZ Chennai</td>
            </tr>
            <tr>
              <td class="font-medium border p-2">Depute Branch</td>
              <td class="border p-2">XYZ</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div>
    <div class="bg-blue-500 text-white p-2">
        <h3 class="text-lg">Earnings & Deductions</h3>
    </div>
    <div class="border border-black">
    <div class="flex justify-between">
    <!-- Left Table for Allowances and Bonuses -->
    <div class="w-1/2 p-2">
        <table class="min-w-full border">
            <thead>
                <tr>
                    <th class="font-medium border p-2">Earnings</th>
                    <th class="text-right border p-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Extracting the values from the payslips array
                $basic_salary = $payslips['basic_salary'];
                $allowances = json_decode($payslips['allowances'], true); // Decode allowances JSON
                $bonus = json_decode($payslips['bonuses'], true); // Decode bonuses JSON

                // Calculate total allowances
                $totalAllowances = 0;
                // Displaying the breakdown of basic salary and total allowances
                echo "<tr>
                        <td class='border p-2'>Basic Salary</td>
                        <td class='text-right border p-2'>INR " . number_format($basic_salary, 2) . "</td>
                      </tr>";

                // Display Allowances
                foreach ($allowances as $allowance) {
                    $totalAllowances += floatval($allowance['amount']);
                    echo "<tr>
                            <td class='border p-2'>{$allowance['name']}</td>
                            <td class='text-right border p-2'>INR " . number_format($allowance['amount'], 2) . "</td>
                          </tr>";
                }

                // Calculate total bonuses
                $totalBonus = 0;
                foreach ($bonus as $b) {
                    $totalBonus += floatval($b['amount']);
                    echo "<tr>
                            <td class='border p-2'>{$b['name']}</td>
                            <td class='text-right border p-2'>INR " . number_format($b['amount'], 2) . "</td>
                          </tr>";
                }

                $totalEarnings = $basic_salary + $totalAllowances + $totalBonus;
                echo "<tr>
                        <td class='border p-2'>Total Allowances</td>
                        <td class='text-right border p-2'>INR " . number_format($totalAllowances, 2) . "</td>
                      </tr>";
                ?>
            </tbody>
        </table>
    </div>

    <!-- Right Table for Deductions -->
    <div class="w-1/2 p-2">
        <table class="min-w-full border">
            <thead>
                <tr>
                    <th class="font-medium border p-2">Deductions</th>
                    <th class="text-right border p-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Extracting deductions
                $deductions = json_decode($payslips['deductions'], true); // Decode deductions JSON

                // Calculate total deductions
                $totalDeductions = 0;

                // Display Deductions
                foreach ($deductions as $deduction) {
                    if ($deduction['is_percentage'] == "1") {
                        // Calculate percentage deduction
                        $percentageDeduction = ($deduction['percentage'] / 100) * $basic_salary;
                        $totalDeductions += $percentageDeduction;
                        echo "<tr>
                                <td class='border p-2'>{$deduction['name']}</td>
                                <td class='text-right border p-2'>INR " . number_format($percentageDeduction, 2) . "</td>
                              </tr>";
                    } else {
                        // Handle fixed amount deductions
                        $totalDeductions += floatval($deduction['amount']);
                        echo "<tr>
                                <td class='border p-2'>{$deduction['name']}</td>
                                <td class='text-right border p-2'>INR " . number_format($deduction['amount'], 2) . "</td>
                              </tr>";
                    }
                }

                // Displaying the total deductions
                // echo "<tr>
                //         <td class='border p-2'>Total Deductions</td>
                //         <td class='text-right border p-2'>INR " . number_format($totalDeductions, 2) . "</td>
                //       </tr>";
                ?>
            </tbody>
        </table>
    </div>
</div>


    <div class="mt-6 grid grid-cols-2 gap-4 border border-top-black">
        <div>
            <div class="p-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">Total Earnings</span>
                    <span>INR <?php echo number_format($totalEarnings, 2); ?></span>
                </div>
            </div>
        </div>
        <div class="border border-left-black">
            <div class="p-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">Total Deductions</span>
                    <span>INR <?php echo number_format($totalDeductions, 2); ?></span>
                </div>
            </div>
        </div>
    </div>

    </div>
    
   <div class="mt-6 flex flex-col md:flex-row justify-between items-start md:items-center">
    <div class="flex w-xl flex-col border border-black">
        <div class="flex items-center w-full text-center border-b border-black">
            <span class="w-1/2 bg-blue-400 p-2 text-white font-semibold">Net Pay</span>
            <?php 
                $finalTotal = $totalEarnings - $totalDeductions; // Keep it as a number for calculation
            ?>
            <span class="w-1/2 text-xl font-bold">INR <?php echo (int) $finalTotal; ?></span>
        </div>
        <div class="my-2">
            <p class="text-sm"><?php echo numberToWords($finalTotal); ?> Only</p> <!-- Pass the number directly -->
        </div>
    </div>
    <p class="mt-4 md:mt-0 w-xl text-sm">**This is a computer-generated payslip and does not require a signature.</p>
</div>



</div>
  </div>
</div>

<div id="downloading-modal" class="modal">
    <div class="modal-content">
        <p>Downloading...</p>
    </div>
</div>
<?php
   function numberToWords($num) {
    $ones = [
        "", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
        "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen",
        "Seventeen", "Eighteen", "Nineteen"
    ];
    $tens = [
        "", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"
    ];
    $thousands = ["", "Thousand", "Million", "Billion"];
    
    if ($num == 0) {
        return "Zero";
    }
    
    $words = "";
    $place = 0;

    while ($num > 0) {
        $part = $num % 1000;
        if ($part > 0) {
            $words = convertThreeDigits($part, $ones, $tens) . " " . $thousands[$place] . " " . $words;
        }
        $num = intval($num / 1000);
        $place++;
    }

    return trim($words);
}

function convertThreeDigits($num, $ones, $tens) {
    $result = "";

    if ($num >= 100) {
        $result .= $ones[intval($num / 100)] . " Hundred ";
        $num %= 100;
    }

    if ($num >= 20) {
        $result .= $tens[intval($num / 10)] . " ";
        $num %= 10;
    }

    if ($num > 0) {
        $result .= $ones[$num] . " ";
    }

    return trim($result);
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.3/purify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.getElementById('download-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;

    // Show the downloading modal
    document.getElementById('downloading-modal').style.display = 'flex';

    // Define A4 dimensions in millimeters
    const a4Width = 210;
    const a4Height = 297;
    
    const pdf = new jsPDF('p', 'mm', 'a4');
    const content = document.querySelector('.pdf-content');
    
    html2canvas(content, { scale: 2 }).then((canvas) => {
        const imgData = canvas.toDataURL('image/png');
        const imgWidth = a4Width;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Add image to the PDF
        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

        // Define the filename dynamically
        const employeeName = "<?= $employee['name'] ?>";
        const payslipDate = "<?= $payslips['date'] ?>";
        const filename = `${employeeName}_${payslipDate}_payslip.pdf`;

        // Save the PDF and hide the modal after download is complete
        pdf.save(filename);
        document.getElementById('downloading-modal').style.display = 'none';
    });
});
</script>

<!-- Modal CSS -->
<style>
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}
</style>

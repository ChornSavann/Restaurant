<script>
    function printReceipt(cart) {
        if (cart.length === 0) {
            alert("មិនមានទំនិញក្នុងកន្ត្រកទេ!");
            return;
        }

        let shopName = "ភោជនីយ៍ដ្ឋាន CLASSY SAVANN";
        let cashier = "អ្នកគ្រប់គ្រង SAVANN";
        let invoiceNo = "INV" + Math.floor(Math.random() * 1000); // Auto generate invoice number
        let dateNow = new Date().toLocaleString();

        let subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        let save = 0; // ប្រសិនបើអ្នកមានបញ្ចុះតម្លៃ អាចគណនានៅទីនេះ
        let total = subtotal - save;

        // Build item rows
        let rows = "";
        cart.forEach(item => {
            rows += `
        <tr>
            <td>${item.name}</td>
            <td class="right">${item.quantity}</td>
            <td class="right">$${item.price.toFixed(2)}</td>
            <td class="right">0.00</td>
            <td class="right">$${(item.price * item.quantity).toFixed(2)}</td>
        </tr>
    `;
        });

        // Open print window
        let printWindow = window.open("", "", "width=400,height=600");
        printWindow.document.write(`
            <html>
            <head>
                <title>វិក្កយបត្រ</title>
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Hanuman:wght@400;700&display=swap');
                    body {
                        font-family: 'Hanuman', monospace;
                        font-size: 13px;
                        width: 58mm;
                        line-height: 1.4;
                    }
                    h2,h3,p { margin: 0; padding: 0; }
                    .center { text-align: center; }
                    .right { text-align: right; }
                    .line { border-top: 1px solid #000; margin: 5px 0; }
                    table { width: 100%; border-collapse: collapse; margin-top: 5px; }
                    th, td { font-size: 11px; padding: 2px; }
                    th { border-bottom: 1px solid #000; }
                    .totals td { padding: 3px 0; }
                </style>
            </head>
            <body>
                <div class="center">
                    <h3>${shopName}</h3>
                    <p>ដោយ : ${cashier}</p>
                </div>
                <p>វិក្កយបត្រ: ${invoiceNo} | ${dateNow}</p>

                <table>
                    <thead>
                        <tr>
                            <th>ទំនិញ</th>
                            <th class="right">ចំនួន</th>
                            <th class="right">តម្លៃ</th>
                            <th class="right">បញ្ចុះ(%)</th>
                            <th class="right">សរុប</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rows}
                    </tbody>
                    </table>

                    <div class="line"></div>
                    <table class="totals">
                        <tr>
                            <td><strong>សរុបរង</strong></td>
                            <td class="right">$${subtotal.toFixed(2)}</td>
                        </tr>
                        <tr>
                            <td><strong>បានបញ្ចុះ($)</strong></td>
                            <td class="right">$${save.toFixed(2)}</td>
                        </tr>
                        <tr>
                            <td><strong>សរុបចុងក្រោយ</strong></td>
                            <td class="right"><strong>$${total.toFixed(2)}</strong></td>
                        </tr>
                    </table>

                    <div class="line"></div>
                    <p class="center">សូមអរគុណសម្រាប់ការទិញទំនិញ!</p>
            </body>
            </html>
            `);

        printWindow.document.close();
        printWindow.print();
    }
</script>

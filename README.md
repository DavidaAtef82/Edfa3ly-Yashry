<h1 class="code-line" data-line-start=0 data-line-end=1 ><a id="Edfa3lyYashry_0"></a>Edfa3ly-Yashry</h1>
<p class="has-line-data" data-line-start="2" data-line-end="3"><a href="https://nodesource.com/products/nsolid"><img src="https://avatars3.githubusercontent.com/u/4144954?s=200&amp;v=4" alt="N|Solid"></a></p>
<p class="has-line-data" data-line-start="4" data-line-end="5">Write a program that can price a cart of products, accept multiple products, combine offers, and display a total detailed bill in different currencies (based on user selection).</p>
<h1 class="code-line" data-line-start=6 data-line-end=7 ><a id="Abstract_6"></a>Abstract</h1>
<p class="has-line-data" data-line-start="7" data-line-end="8">This task is the part invoicing system I have did it before,<br/> you can enter to view the code from here 
  https://github.com/DavidaAtef82/invoicing_v2/tree/main/inv
  invoicing For every product sold or service rendered, an invoice is made, the first step for you to get paid, In this task, we have products, offers, and total calculations of all transactions.</p>
<h1 class="code-line" data-line-start=9 data-line-end=10 ><a id="Problem_Definition_9"></a>Problem Definition</h1>
<p class="has-line-data" data-line-start="10" data-line-end="12">the system must be able to add new offers for any products, it means that there are multiple offers for a single product and this offers couldn’t occur without another product must be taken, for example<br>
product A has an offer of 50% if you buy 2 from product B and 2 from product 3, and you have to handle if the customer takes more than 2 from product A Double Offer or tribble offer there are many situations.</p>
<h1 class="code-line" data-line-start=13 data-line-end=14 ><a id="The_Solution_Of_Problem_13"></a>The Solution Of Problem!</h1>
<p class="has-line-data" data-line-start="14" data-line-end="15">I made databse tables for multiple models</p>
<blockquote>
<p class="has-line-data" data-line-start="15" data-line-end="21">tbl_tax --&gt; to save the tax , type and accept multiple tax.<br>
tbl_product --&gt; to save the products , price and tax if exist<br>
tbl_offer --&gt; to create different offers for product.<br>
tbl_offer_depend --&gt; refer to conditions of offer occurrence, it maps the offer depends on which product and how many items you need to the occurrence.<br>
tbl_bill --&gt; refer to final card car or invoice<br>
tbl_bill_row --&gt; refer to rows of the bill or mean the item’s type based (product, tax, discount) and then you have to calculate from this table.</p>
</blockquote>
<p class="has-line-data" data-line-start="22" data-line-end="25">Attention :<br>
you can add and edit in the database<br>
you can add new offers with any offer you added you must add its dependence at table tbl_offer_depend</p>
<h3 class="code-line" data-line-start=25 data-line-end=26 ><a id="Installation_25"></a>Installation</h3>
<ul>
<li class="has-line-data" data-line-start="27" data-line-end="29">
<p class="has-line-data" data-line-start="27" data-line-end="28">import edfa3ly-yashry.sql to your host, it is  <a href="https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/edfa3ly-yashry.sql">https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/edfa3ly-yashry.sql</a></p>
</li>
<li class="has-line-data" data-line-start="29" data-line-end="32">
<p class="has-line-data" data-line-start="29" data-line-end="32">Change database connection configurations<br>
from file inc/connection.php it is<br>
<a href="https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/Edfa3ly-Yashry/inc/connection.php">https://github.com/DavidaAtef82/Edfa3ly-Yashry/blob/main/Edfa3ly-Yashry/inc/connection.php</a></p>
</li>
<li class="has-line-data" data-line-start="32" data-line-end="39">
<p class="has-line-data" data-line-start="32" data-line-end="39">use postman or any other tool to send post request to<br>
Your-host/Edfa3ly-Yashry/<br>
and in the Body add this<br>
| KEY         |  VALUE |<br>
| ---------- | ------ |<br>
| products | T-shirt,T-shirt,Shoes,Jacket |<br>
| currency | EGP |</p>
</li>
<li class="has-line-data" data-line-start="39" data-line-end="41">
<p class="has-line-data" data-line-start="39" data-line-end="41">or use get request Like<br>
Your-host/Edfa3ly-Yashry/index.php?products=T-shirt,T-shirt,Shoes,Jacket</p>
</li>
</ul>

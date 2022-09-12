<?php
include("connection.php");

function get_appointment_in_admin_page_for_table_connection($appointment_id, $customer_name, $appointment_name, $date, $hour, $status)
{
    $element = "
    <tr class=\"hi\">
        <td>$appointment_name</td>
        <td>$customer_name</td>
        <td>$date</td>
        <td>$hour</td>
        <td>
            <span class=\"status red\"></span>
            <a class=\"status_btn\">$status</a>
        </td>
        <td>
            <a>
                <button class=\"btn_done_work\" id=\"SetStatusButton\" onclick=\"SetAppointmentID($appointment_id);\"></button>
            </a>
        </td>
    </tr>
    ";
    echo $element;
}


function latest_customers_connection($username, $email)
{
    $element = "
    <div class=\"customer\">
        <div class=\"info\">
            <img src=\"../images/console.png\" alt=\"\" width=\"40px\" height=\"40px\">
            <div>
                <h4>$username</h4>
                <small>$email</small>
            </div>
        </div>
    </div>
    ";
    echo $element;
}

function latest_admins_connection($first_name, $last_name, $email_address)
{
    $element = "
    <div class=\"customer\">
        <div class=\"info\">
            <img src=\"../images/console.png\" alt=\"\" width=\"40px\" height=\"40px\">
            <div>
                <h4>$first_name $last_name</h4>
                <small>$email_address</small>
            </div>
        </div>
    </div>
    ";
    echo $element;
}

function get_comments_connection($username, $comment)
{
    $element = "
    <tr class=\"hello\">
    <td>$username</td>
    <td>$comment</td>
</tr>
    ";
    echo $element;
}

function get_all_customer_connection($customer_id, $first_name, $last_name, $username, $email, $phone_number, $address, $date_of_birth)
{
    $element = "
    <tr>
        <td>$first_name $last_name</td>
        <td>$username</td>
        <td>$email</td>
        <td>$phone_number</td>
        <td>$address</td>
        <td>$date_of_birth</td>
        <td>
        <a>
            <button class=\"remove_cust\" onclick=\"OpenRemoveCustomerPopUp($customer_id, `$first_name`, `$last_name`)\">Remove</button>
        </a>
    </tr>
    ";
    echo $element;
}

function get_all_admins_connection($admin_id, $admin_first_name, $admin_last_name, $admin_name, $email_address, $phone_number)
{
    $element = "
    <tr>
        <td>$admin_first_name $admin_last_name</td>
        <td>$admin_name</td>
        <td>$email_address</td>
        <td>$phone_number</td>
        <td>
            <a href=\"../admin-admin/admin-admin.php?getAdminIDtoRemove=$admin_id\">
                <button class=\"remove_cust\">Remove</button>
            </a>
        </td>
    </tr>";

    echo $element;
}

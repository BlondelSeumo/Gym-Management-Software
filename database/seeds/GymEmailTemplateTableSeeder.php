<?php

use Illuminate\Database\Seeder;
use App\Models\GymEmailTemplates;

class GymEmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emailTemplates = [
            'title 1' => [
                'some description some description some description some description some description some description some description some description some description some description',
                'welcome.png',
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
<style type="text/css">
    #outlook a {padding: 0; }
    body {
        width: 100% !important;
        min-width: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        margin: 0;
        Margin: 0;
        padding: 0;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box; }

    .ExternalClass {
        width: 100%; }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
            line-height: 100%; }

    #backgroundTable {
        margin: 0;
        Margin: 0;
        padding: 0;
        width: 100% !important;
        line-height: 100% !important; }

    img {
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        width: auto;
        max-width: 100%;
        clear: both;
        display: block; }

    center {
        width: 100%;
        min-width: 580px; }

    a img {
        border: none; }

    p {
        margin: 0 0 0 10px;
        Margin: 0 0 0 10px; }

    table {
        border-spacing: 0;
        border-collapse: collapse; }

    td {
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
        border-collapse: collapse !important; }

    table, tr, td {
        padding: 0;
        vertical-align: top;
        text-align: left; }

    html {
        min-height: 100%;
        background: #f0f0f0; }

    table.body {
        background: #f0f0f0;
        height: 100%;
        width: 100%; }

    table.container {
        background: #fefefe;
        width: 580px;
        margin: 0 auto;
        Margin: 0 auto;
        text-align: inherit; }

    table.row {
        padding: 0;
        width: 100%;
        position: relative; }

    table.container table.row {
        display: table; }

    td.columns,
    td.column,
    th.columns,
    th.column {
        margin: 0 auto;
        Margin: 0 auto;
        padding-left: 16px;
        padding-bottom: 16px; }

    td.columns.last,
    td.column.last,
    th.columns.last,
    th.column.last {
        padding-right: 16px; }

    td.columns table,
    td.column table,
    th.columns table,
    th.column table {
        width: 100%; }

    td.large-1,
    th.large-1 {
        width: 32.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-1.first,
    th.large-1.first {
        padding-left: 16px; }

    td.large-1.last,
    th.large-1.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-1,
    .collapse > tbody > tr > th.large-1 {
        padding-right: 0;
        padding-left: 0;
        width: 48.33333px; }

    .collapse td.large-1.first,
    .collapse th.large-1.first,
    .collapse td.large-1.last,
    .collapse th.large-1.last {
        width: 56.33333px; }

    td.large-2,
    th.large-2 {
        width: 80.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-2.first,
    th.large-2.first {
        padding-left: 16px; }

    td.large-2.last,
    th.large-2.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-2,
    .collapse > tbody > tr > th.large-2 {
        padding-right: 0;
        padding-left: 0;
        width: 96.66667px; }

    .collapse td.large-2.first,
    .collapse th.large-2.first,
    .collapse td.large-2.last,
    .collapse th.large-2.last {
        width: 104.66667px; }

    td.large-3,
    th.large-3 {
        width: 129px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-3.first,
    th.large-3.first {
        padding-left: 16px; }

    td.large-3.last,
    th.large-3.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-3,
    .collapse > tbody > tr > th.large-3 {
        padding-right: 0;
        padding-left: 0;
        width: 145px; }

    .collapse td.large-3.first,
    .collapse th.large-3.first,
    .collapse td.large-3.last,
    .collapse th.large-3.last {
        width: 153px; }

    td.large-4,
    th.large-4 {
        width: 177.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-4.first,
    th.large-4.first {
        padding-left: 16px; }

    td.large-4.last,
    th.large-4.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-4,
    .collapse > tbody > tr > th.large-4 {
        padding-right: 0;
        padding-left: 0;
        width: 193.33333px; }

    .collapse td.large-4.first,
    .collapse th.large-4.first,
    .collapse td.large-4.last,
    .collapse th.large-4.last {
        width: 201.33333px; }

    td.large-5,
    th.large-5 {
        width: 225.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-5.first,
    th.large-5.first {
        padding-left: 16px; }

    td.large-5.last,
    th.large-5.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-5,
    .collapse > tbody > tr > th.large-5 {
        padding-right: 0;
        padding-left: 0;
        width: 241.66667px; }

    .collapse td.large-5.first,
    .collapse th.large-5.first,
    .collapse td.large-5.last,
    .collapse th.large-5.last {
        width: 249.66667px; }

    td.large-6,
    th.large-6 {
        width: 274px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-6.first,
    th.large-6.first {
        padding-left: 16px; }

    td.large-6.last,
    th.large-6.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-6,
    .collapse > tbody > tr > th.large-6 {
        padding-right: 0;
        padding-left: 0;
        width: 290px; }

    .collapse td.large-6.first,
    .collapse th.large-6.first,
    .collapse td.large-6.last,
    .collapse th.large-6.last {
        width: 298px; }

    td.large-7,
    th.large-7 {
        width: 322.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-7.first,
    th.large-7.first {
        padding-left: 16px; }

    td.large-7.last,
    th.large-7.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-7,
    .collapse > tbody > tr > th.large-7 {
        padding-right: 0;
        padding-left: 0;
        width: 338.33333px; }

    .collapse td.large-7.first,
    .collapse th.large-7.first,
    .collapse td.large-7.last,
    .collapse th.large-7.last {
        width: 346.33333px; }

    td.large-8,
    th.large-8 {
        width: 370.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-8.first,
    th.large-8.first {
        padding-left: 16px; }

    td.large-8.last,
    th.large-8.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-8,
    .collapse > tbody > tr > th.large-8 {
        padding-right: 0;
        padding-left: 0;
        width: 386.66667px; }

    .collapse td.large-8.first,
    .collapse th.large-8.first,
    .collapse td.large-8.last,
    .collapse th.large-8.last {
        width: 394.66667px; }

    td.large-9,
    th.large-9 {
        width: 419px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-9.first,
    th.large-9.first {
        padding-left: 16px; }

    td.large-9.last,
    th.large-9.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-9,
    .collapse > tbody > tr > th.large-9 {
        padding-right: 0;
        padding-left: 0;
        width: 435px; }

    .collapse td.large-9.first,
    .collapse th.large-9.first,
    .collapse td.large-9.last,
    .collapse th.large-9.last {
        width: 443px; }

    td.large-10,
    th.large-10 {
        width: 467.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-10.first,
    th.large-10.first {
        padding-left: 16px; }

    td.large-10.last,
    th.large-10.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-10,
    .collapse > tbody > tr > th.large-10 {
        padding-right: 0;
        padding-left: 0;
        width: 483.33333px; }

    .collapse td.large-10.first,
    .collapse th.large-10.first,
    .collapse td.large-10.last,
    .collapse th.large-10.last {
        width: 491.33333px; }

    td.large-11,
    th.large-11 {
        width: 515.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-11.first,
    th.large-11.first {
        padding-left: 16px; }

    td.large-11.last,
    th.large-11.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-11,
    .collapse > tbody > tr > th.large-11 {
        padding-right: 0;
        padding-left: 0;
        width: 531.66667px; }

    .collapse td.large-11.first,
    .collapse th.large-11.first,
    .collapse td.large-11.last,
    .collapse th.large-11.last {
        width: 539.66667px; }

    td.large-12,
    th.large-12 {
        width: 564px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-12.first,
    th.large-12.first {
        padding-left: 16px; }

    td.large-12.last,
    th.large-12.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-12,
    .collapse > tbody > tr > th.large-12 {
        padding-right: 0;
        padding-left: 0;
        width: 580px; }

    .collapse td.large-12.first,
    .collapse th.large-12.first,
    .collapse td.large-12.last,
    .collapse th.large-12.last {
        width: 588px; }

    td.large-1 center,
    th.large-1 center {
        min-width: 0.33333px; }

    td.large-2 center,
    th.large-2 center {
        min-width: 48.66667px; }

    td.large-3 center,
    th.large-3 center {
        min-width: 97px; }

    td.large-4 center,
    th.large-4 center {
        min-width: 145.33333px; }

    td.large-5 center,
    th.large-5 center {
        min-width: 193.66667px; }

    td.large-6 center,
    th.large-6 center {
        min-width: 242px; }

    td.large-7 center,
    th.large-7 center {
        min-width: 290.33333px; }

    td.large-8 center,
    th.large-8 center {
        min-width: 338.66667px; }

    td.large-9 center,
    th.large-9 center {
        min-width: 387px; }

    td.large-10 center,
    th.large-10 center {
        min-width: 435.33333px; }

    td.large-11 center,
    th.large-11 center {
        min-width: 483.66667px; }

    td.large-12 center,
    th.large-12 center {
        min-width: 532px; }

    .body .columns td.large-1,
    .body .column td.large-1,
    .body .columns th.large-1,
    .body .column th.large-1 {
        width: 8.33333%; }

    .body .columns td.large-2,
    .body .column td.large-2,
    .body .columns th.large-2,
    .body .column th.large-2 {
        width: 16.66667%; }

    .body .columns td.large-3,
    .body .column td.large-3,
    .body .columns th.large-3,
    .body .column th.large-3 {
        width: 25%; }

    .body .columns td.large-4,
    .body .column td.large-4,
    .body .columns th.large-4,
    .body .column th.large-4 {
        width: 33.33333%; }

    .body .columns td.large-5,
    .body .column td.large-5,
    .body .columns th.large-5,
    .body .column th.large-5 {
        width: 41.66667%; }

    .body .columns td.large-6,
    .body .column td.large-6,
    .body .columns th.large-6,
    .body .column th.large-6 {
        width: 50%; }

    .body .columns td.large-7,
    .body .column td.large-7,
    .body .columns th.large-7,
    .body .column th.large-7 {
        width: 58.33333%; }

    .body .columns td.large-8,
    .body .column td.large-8,
    .body .columns th.large-8,
    .body .column th.large-8 {
        width: 66.66667%; }

    .body .columns td.large-9,
    .body .column td.large-9,
    .body .columns th.large-9,
    .body .column th.large-9 {
        width: 75%; }

    .body .columns td.large-10,
    .body .column td.large-10,
    .body .columns th.large-10,
    .body .column th.large-10 {
        width: 83.33333%; }

    .body .columns td.large-11,
    .body .column td.large-11,
    .body .columns th.large-11,
    .body .column th.large-11 {
        width: 91.66667%; }

    .body .columns td.large-12,
    .body .column td.large-12,
    .body .columns th.large-12,
    .body .column th.large-12 {
        width: 100%; }

    td.large-offset-1,
    td.large-offset-1.first,
    td.large-offset-1.last,
    th.large-offset-1,
    th.large-offset-1.first,
    th.large-offset-1.last {
        padding-left: 64.33333px; }

    td.large-offset-2,
    td.large-offset-2.first,
    td.large-offset-2.last,
    th.large-offset-2,
    th.large-offset-2.first,
    th.large-offset-2.last {
        padding-left: 112.66667px; }

    td.large-offset-3,
    td.large-offset-3.first,
    td.large-offset-3.last,
    th.large-offset-3,
    th.large-offset-3.first,
    th.large-offset-3.last {
        padding-left: 161px; }

    td.large-offset-4,
    td.large-offset-4.first,
    td.large-offset-4.last,
    th.large-offset-4,
    th.large-offset-4.first,
    th.large-offset-4.last {
        padding-left: 209.33333px; }

    td.large-offset-5,
    td.large-offset-5.first,
    td.large-offset-5.last,
    th.large-offset-5,
    th.large-offset-5.first,
    th.large-offset-5.last {
        padding-left: 257.66667px; }

    td.large-offset-6,
    td.large-offset-6.first,
    td.large-offset-6.last,
    th.large-offset-6,
    th.large-offset-6.first,
    th.large-offset-6.last {
        padding-left: 306px; }

    td.large-offset-7,
    td.large-offset-7.first,
    td.large-offset-7.last,
    th.large-offset-7,
    th.large-offset-7.first,
    th.large-offset-7.last {
        padding-left: 354.33333px; }

    td.large-offset-8,
    td.large-offset-8.first,
    td.large-offset-8.last,
    th.large-offset-8,
    th.large-offset-8.first,
    th.large-offset-8.last {
        padding-left: 402.66667px; }

    td.large-offset-9,
    td.large-offset-9.first,
    td.large-offset-9.last,
    th.large-offset-9,
    th.large-offset-9.first,
    th.large-offset-9.last {
        padding-left: 451px; }

    td.large-offset-10,
    td.large-offset-10.first,
    td.large-offset-10.last,
    th.large-offset-10,
    th.large-offset-10.first,
    th.large-offset-10.last {
        padding-left: 499.33333px; }

    td.large-offset-11,
    td.large-offset-11.first,
    td.large-offset-11.last,
    th.large-offset-11,
    th.large-offset-11.first,
    th.large-offset-11.last {
        padding-left: 547.66667px; }

    td.expander,
    th.expander {
        visibility: hidden;
        width: 0;
        padding: 0 !important; }

    .block-grid {
        width: 100%;
        max-width: 580px; }
    .block-grid td {
        display: inline-block;
        padding: 8px; }

    .up-2 td {
        width: 274px !important; }

    .up-3 td {
        width: 177px !important; }

    .up-4 td {
        width: 129px !important; }

    .up-5 td {
        width: 100px !important; }

    .up-6 td {
        width: 80px !important; }

    .up-7 td {
        width: 66px !important; }

    .up-8 td {
        width: 56px !important; }

    table.text-center,
    td.text-center,
    h1.text-center,
    h2.text-center,
    h3.text-center,
    h4.text-center,
    h5.text-center,
    h6.text-center,
    p.text-center,
    span.text-center {
        text-align: center; }

    h1.text-left,
    h2.text-left,
    h3.text-left,
    h4.text-left,
    h5.text-left,
    h6.text-left,
    p.text-left,
    span.text-left {
        text-align: left; }

    h1.text-right,
    h2.text-right,
    h3.text-right,
    h4.text-right,
    h5.text-right,
    h6.text-right,
    p.text-right,
    span.text-right {
        text-align: right; }

    span.text-center {
        display: block;
        width: 100%;
        text-align: center; }

    img.float-left {
        float: left;
        text-align: left; }

    img.float-right {
        float: right;
        text-align: right; }

    img.float-center,
    img.text-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.float-center,
    td.float-center,
    th.float-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.body table.container .hide-for-large {
        display: none;
        width: 0;
        mso-hide: all;
        overflow: hidden;
        max-height: 0px;
        font-size: 0;
        width: 0px;
        line-height: 0; }

    body,
    table.body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    td,
    th,
    a {
        color: #0a0a0a;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        padding: 0;
        margin: 0;
        Margin: 0;
        text-align: left;
        line-height: 1.3; }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: inherit;
        word-wrap: normal;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        margin-bottom: 10px;
        Margin-bottom: 10px; }

    h1 {
        font-size: 34px; }

    h2 {
        font-size: 30px; }

    h3 {
        font-size: 28px; }

    h4 {
        font-size: 24px; }

    h5 {
        font-size: 20px; }

    h6 {
        font-size: 18px; }

    body,
    table.body,
    p,
    td,
    th {
        font-size: 15px;
        line-height: 19px; }

    p {
        margin-bottom: 10px;
        Margin-bottom: 10px; }
    p.lead {
        font-size: 18.75px;
        line-height: 1.6; }
    p.subheader {
        margin-top: 4px;
        margin-bottom: 8px;
        Margin-top: 4px;
        Margin-bottom: 8px;
        font-weight: normal;
        line-height: 1.4;
        color: #8a8a8a; }

    small {
        font-size: 80%;
        color: #cacaca; }

    a {
        color: #f7931d;
        text-decoration: none; }
    a:hover {
        color: #d97908; }
    a:active {
        color: #d97908; }
    a:visited {
        color: #f7931d; }

    h1 a,
    h1 a:visited,
    h2 a,
    h2 a:visited,
    h3 a,
    h3 a:visited,
    h4 a,
    h4 a:visited,
    h5 a,
    h5 a:visited,
    h6 a,
    h6 a:visited {
        color: #f7931d; }

    pre {
        background: #f0f0f0;
        margin: 30px 0;
        Margin: 30px 0; }
    pre code {
        color: #cacaca; }
        pre code span.callout {
            color: #8a8a8a;
            font-weight: bold; }
    pre code span.callout-strong {
        color: #ff6908;
        font-weight: bold; }

    hr {
        max-width: 580px;
        height: 0;
        border-right: 0;
        border-top: 0;
        border-bottom: 1px solid #cacaca;
        border-left: 0;
        margin: 20px auto;
        Margin: 20px auto;
        clear: both; }

    .stat {
        font-size: 40px;
        line-height: 1; }
    p + .stat {
        margin-top: -16px;
        Margin-top: -16px; }

    table.button {
        width: auto !important;
        margin: 0 0 16px 0;
        Margin: 0 0 16px 0; }
    table.button table td {
        width: auto !important;
        text-align: left;
        color: #fefefe;
        background: #f7931d;
        border: 2px solid #f7931d; }
        table.button table td.radius {
            border-radius: 3px; }
    table.button table td.rounded {
        border-radius: 500px; }
        table.button table td a {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #fefefe;
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px 8px 16px;
            border: 0px solid #f7931d;
            border-radius: 3px; }

    table.button:hover table tr td a,
    table.button:active table tr td a,
    table.button table tr td a:visited,
    table.button.tiny:hover table tr td a,
    table.button.tiny:active table tr td a,
    table.button.tiny table tr td a:visited,
    table.button.small:hover table tr td a,
    table.button.small:active table tr td a,
    table.button.small table tr td a:visited,
    table.button.large:hover table tr td a,
    table.button.large:active table tr td a,
    table.button.large table tr td a:visited {
        color: #fefefe; }

    table.button.tiny table td,
    table.button.tiny table a {
        padding: 4px 8px 4px 8px; }

    table.button.tiny table a {
        font-size: 10px;
        font-weight: normal; }

    table.button.small table td,
    table.button.small table a {
        padding: 5px 10px 5px 10px;
        font-size: 12px; }

    table.button.large table a {
        padding: 10px 20px 10px 20px;
        font-size: 20px; }

    table.expand,
    table.expanded {
        width: 100% !important; }
    table.expand table,
    table.expanded table {
        width: 100%; }
        table.expand table a,
        table.expanded table a {
            text-align: center; }
    table.expand center,
    table.expanded center {
        min-width: 0; }

    table.button:hover table td,
    table.button:visited table td,
    table.button:active table td {
        background: #d97908;
        color: #fefefe; }

    table.button:hover table a,
    table.button:visited table a,
    table.button:active table a {
        border: 0px solid #d97908; }

    table.button.secondary table td {
        background: #777777;
        color: #fefefe;
        border: 2px solid #777777; }

    table.button.secondary table a {
        color: #fefefe;
        border: 0px solid #777777; }

    table.button.secondary:hover table td {
        background: #919191;
        color: #fefefe; }

    table.button.secondary:hover table a {
        border: 0px solid #919191; }

    table.button.secondary:hover table td a {
        color: #fefefe; }

    table.button.secondary:active table td a {
        color: #fefefe; }

    table.button.secondary table td a:visited {
        color: #fefefe; }

    table.button.success table td {
        background: #3adb76;
        border: 2px solid #3adb76; }

    table.button.success table a {
        border: 0px solid #3adb76; }

    table.button.success:hover table td {
        background: #23bf5d; }

    table.button.success:hover table a {
        border: 0px solid #23bf5d; }

    table.button.alert table td {
        background: #ec5840;
        border: 2px solid #ec5840; }

    table.button.alert table a {
        border: 0px solid #ec5840; }

    table.button.alert:hover table td {
        background: #e23317; }

    table.button.alert:hover table a {
        border: 0px solid #e23317; }

    table.callout {
        margin-bottom: 16px;
        Margin-bottom: 16px; }

    th.callout-inner {
        width: 100%;
        border: 1px solid #cbcbcb;
        padding: 10px;
        background: #fefefe; }
    th.callout-inner.primary {
        background: #feefdd;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.secondary {
        background: #ebebeb;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.success {
        background: #e1faea;
        border: 1px solid #1b9448;
        color: #fefefe; }
    th.callout-inner.warning {
        background: #fff3d9;
        border: 1px solid #996800;
        color: #fefefe; }
    th.callout-inner.alert {
        background: #fce6e2;
        border: 1px solid #b42912;
        color: #fefefe; }

    .thumbnail {
        border: solid 4px #fefefe;
        box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
        display: inline-block;
        line-height: 0;
        max-width: 100%;
        transition: box-shadow 200ms ease-out;
        border-radius: 3px;
        margin-bottom: 16px; }
    .thumbnail:hover, .thumbnail:focus {
        box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

    table.menu {
        width: 580px; }
    table.menu td.menu-item,
    table.menu th.menu-item {
        padding: 10px;
        padding-right: 10px; }
        table.menu td.menu-item a,
        table.menu th.menu-item a {
            color: #f7931d; }

    table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item {
        padding: 10px;
        padding-right: 0;
        display: block; }
    table.menu.vertical td.menu-item a,
    table.menu.vertical th.menu-item a {
        width: 100%; }

    table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
        padding-left: 10px; }

    table.menu.text-center a {
        text-align: center; }

    .menu[align="center"] {
        width: auto !important; }

    body.outlook p {
        display: inline !important; }



    .footer-drip {
        background: #F3F3F3;
        border-radius: 0 0 10px 10px; }

    .footer-drip .columns {
        padding-top: 16px; }

    .container.header-drip {
        background: #F3F3F3; }

    .container.header-drip .columns {
        padding-bottom: 16px;
        padding-top: 16px; }

    .container.body-drip {
        border-radius: 10px;
        border-top: 10px solid #663399; }

    .header {
        background: #8a8a8a; }

    .header p {
        color: #ffffff;
        margin: 0; }

    .header .columns {
        padding-bottom: 0; }

    .header .container {
        background: #8a8a8a;
        padding-top: 16px;
        padding-bottom: 16px; }

    .header .container td {
        padding-top: 16px;
        padding-bottom: 16px; }

    .grey {
        background: #f0f0f0; }

    .border-test {
        border: 1px solid #ccc; }

    .masthead {
        background: #212121; }

    .swu-logo {
        width: 170px;
        height: auto;
        padding: 15px 0px 0px 0px; }

    .masthead h1 {
        color: #f7931d;
        padding: 35px 0px 15px 0px; }

    .column-border {
        border: 1px solid #eee; }

    .footercopy {
        padding: 20px 0px;
        font-size: 12px;
        color: #777777; }

    p {
        color: #777777 !important; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .hide-for-large {
            display: block !important;
            width: auto !important;
            overflow: visible !important; } }

    table.body table.container .hide-for-large * {
        mso-hide: all; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .row.hide-for-large,
        table.body table.container .row.hide-for-large {
            display: table !important;
            width: 100% !important; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .show-for-large {
            display: none !important;
            width: 0;
            mso-hide: all;
            overflow: hidden; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body img {
            width: auto !important;
            height: auto !important; }
    table.body center {
        min-width: 0 !important; }
    table.body .container {
        width: 95% !important; }
    table.body .columns,
    table.body .column {
        height: auto !important;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding-left: 16px !important;
        padding-right: 16px !important; }
        table.body .columns .column,
        table.body .columns .columns,
        table.body .column .column,
        table.body .column .columns {
            padding-left: 0 !important;
            padding-right: 0 !important; }
    table.body .collapse .columns,
    table.body .collapse .column {
        padding-left: 0 !important;
        padding-right: 0 !important; }
    td.small-1,
    th.small-1 {
        display: inline-block !important;
        width: 8.33333% !important; }
    td.small-2,
    th.small-2 {
        display: inline-block !important;
        width: 16.66667% !important; }
    td.small-3,
    th.small-3 {
        display: inline-block !important;
        width: 25% !important; }
    td.small-4,
    th.small-4 {
        display: inline-block !important;
        width: 33.33333% !important; }
    td.small-5,
    th.small-5 {
        display: inline-block !important;
        width: 41.66667% !important; }
    td.small-6,
    th.small-6 {
        display: inline-block !important;
        width: 50% !important; }
    td.small-7,
    th.small-7 {
        display: inline-block !important;
        width: 58.33333% !important; }
    td.small-8,
    th.small-8 {
        display: inline-block !important;
        width: 66.66667% !important; }
    td.small-9,
    th.small-9 {
        display: inline-block !important;
        width: 75% !important; }
    td.small-10,
    th.small-10 {
        display: inline-block !important;
        width: 83.33333% !important; }
    td.small-11,
    th.small-11 {
        display: inline-block !important;
        width: 91.66667% !important; }
    td.small-12,
    th.small-12 {
        display: inline-block !important;
        width: 100% !important; }
    .columns td.small-12,
    .column td.small-12,
    .columns th.small-12,
    .column th.small-12 {
        display: block !important;
        width: 100% !important; }
    .body .columns td.small-1,
    .body .column td.small-1,
    td.small-1 center,
    .body .columns th.small-1,
    .body .column th.small-1,
    th.small-1 center {
        display: inline-block !important;
        width: 8.33333% !important; }
    .body .columns td.small-2,
    .body .column td.small-2,
    td.small-2 center,
    .body .columns th.small-2,
    .body .column th.small-2,
    th.small-2 center {
        display: inline-block !important;
        width: 16.66667% !important; }
    .body .columns td.small-3,
    .body .column td.small-3,
    td.small-3 center,
    .body .columns th.small-3,
    .body .column th.small-3,
    th.small-3 center {
        display: inline-block !important;
        width: 25% !important; }
    .body .columns td.small-4,
    .body .column td.small-4,
    td.small-4 center,
    .body .columns th.small-4,
    .body .column th.small-4,
    th.small-4 center {
        display: inline-block !important;
        width: 33.33333% !important; }
    .body .columns td.small-5,
    .body .column td.small-5,
    td.small-5 center,
    .body .columns th.small-5,
    .body .column th.small-5,
    th.small-5 center {
        display: inline-block !important;
        width: 41.66667% !important; }
    .body .columns td.small-6,
    .body .column td.small-6,
    td.small-6 center,
    .body .columns th.small-6,
    .body .column th.small-6,
    th.small-6 center {
        display: inline-block !important;
        width: 50% !important; }
    .body .columns td.small-7,
    .body .column td.small-7,
    td.small-7 center,
    .body .columns th.small-7,
    .body .column th.small-7,
    th.small-7 center {
        display: inline-block !important;
        width: 58.33333% !important; }
    .body .columns td.small-8,
    .body .column td.small-8,
    td.small-8 center,
    .body .columns th.small-8,
    .body .column th.small-8,
    th.small-8 center {
        display: inline-block !important;
        width: 66.66667% !important; }
    .body .columns td.small-9,
    .body .column td.small-9,
    td.small-9 center,
    .body .columns th.small-9,
    .body .column th.small-9,
    th.small-9 center {
        display: inline-block !important;
        width: 75% !important; }
    .body .columns td.small-10,
    .body .column td.small-10,
    td.small-10 center,
    .body .columns th.small-10,
    .body .column th.small-10,
    th.small-10 center {
        display: inline-block !important;
        width: 83.33333% !important; }
    .body .columns td.small-11,
    .body .column td.small-11,
    td.small-11 center,
    .body .columns th.small-11,
    .body .column th.small-11,
    th.small-11 center {
        display: inline-block !important;
        width: 91.66667% !important; }
    table.body td.small-offset-1,
    table.body th.small-offset-1 {
        margin-left: 8.33333% !important;
        Margin-left: 8.33333% !important; }
    table.body td.small-offset-2,
    table.body th.small-offset-2 {
        margin-left: 16.66667% !important;
        Margin-left: 16.66667% !important; }
    table.body td.small-offset-3,
    table.body th.small-offset-3 {
        margin-left: 25% !important;
        Margin-left: 25% !important; }
    table.body td.small-offset-4,
    table.body th.small-offset-4 {
        margin-left: 33.33333% !important;
        Margin-left: 33.33333% !important; }
    table.body td.small-offset-5,
    table.body th.small-offset-5 {
        margin-left: 41.66667% !important;
        Margin-left: 41.66667% !important; }
    table.body td.small-offset-6,
    table.body th.small-offset-6 {
        margin-left: 50% !important;
        Margin-left: 50% !important; }
    table.body td.small-offset-7,
    table.body th.small-offset-7 {
        margin-left: 58.33333% !important;
        Margin-left: 58.33333% !important; }
    table.body td.small-offset-8,
    table.body th.small-offset-8 {
        margin-left: 66.66667% !important;
        Margin-left: 66.66667% !important; }
    table.body td.small-offset-9,
    table.body th.small-offset-9 {
        margin-left: 75% !important;
        Margin-left: 75% !important; }
    table.body td.small-offset-10,
    table.body th.small-offset-10 {
        margin-left: 83.33333% !important;
        Margin-left: 83.33333% !important; }
    table.body td.small-offset-11,
    table.body th.small-offset-11 {
        margin-left: 91.66667% !important;
        Margin-left: 91.66667% !important; }
    table.body table.columns td.expander,
    table.body table.columns th.expander {
        display: none !important; }
    table.body .right-text-pad,
    table.body .text-pad-right {
        padding-left: 10px !important; }
    table.body .left-text-pad,
    table.body .text-pad-left {
        padding-right: 10px !important; }
    table.menu {
        width: 100% !important; }
        table.menu td,
        table.menu th {
            width: auto !important;
            display: inline-block !important; }
    table.menu.vertical td,
    table.menu.vertical th, table.menu.small-vertical td,
    table.menu.small-vertical th {
        display: block !important; }
    table.menu[align="center"] {
        width: auto !important; }
    table.button.expand {
        width: 100% !important; }
    }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        .small-float-center {
            margin: 0 auto !important;
            float: none !important;
            text-align: center !important; }
        .small-text-center {
            text-align: center !important; }
        .small-text-left {
        text-align: left !important; }
        .small-text-right {
        text-align: right !important; }
    }
</style>

    </head>
    <body>
        <table class="body">
            <tr>
                <td class="center" align="center" valign="top">
                    <center data-parsed="">
                        <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                                        <table class="row grey"><tbody><tr>
                                                    <th class="small-12 large-12 columns first last">
                                                        <table>
                                                            <tr>
                                                                <th>
                                                                    &#xA0; 
                                                                </th>
                                                                <th class="expander"></th>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr></tbody></table>
                                    </td></tr></tbody></table>

                                    <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                                                    <table class="row"><tbody><tr> <!-- Logo -->
                                                                <th class="small-12 large-12 columns first last">
                                                                    <table>
                                                                        <tr>
                                                                            <th>
                                                                                <center data-parsed="">
                                                                                    <a href="http://www.sendwithus.com" align="center" class="text-center">
                                                                                        <img src="https://www.sendwithus.com/assets/img/zurb-template-images/logo-placeholder.png" class="swu-logo">
                                                                                    </a>
                                                                                </center>
                                                                            </th>
                                                                            <th class="expander"></th>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr></tbody></table>
                                                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                                                        <th class="small-12 large-12 columns first last">
                                                                            <table>
                                                                                <tr>
                                                                                    <th>
                                                                                        <h1 class="text-center">Welcome Email!</h1>
                                                                                        <center data-parsed="">
                                                                                            <img src="https://www.sendwithus.com/assets/img/zurb-template-images/cat-placeholder.png" valign="bottom" align="center" class="text-center">
                                                                                        </center>
                                                                                    </th>
                                                                                    <th class="expander"></th>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                    </tr></tbody></table>
                                                                    <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                                                                <th class="small-12 large-12 columns first last">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <th>
                                                                                                &#xA0; 
                                                                                            </th>
                                                                                            <th class="expander"></th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </th>
                                                                            </tr></tbody></table>
                                                                            <table class="row"><tbody><tr> <!-- main Email content -->
                                                                                        <th class="small-12 large-12 columns first last">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <th>
                                                                                                        <b><h5>Welcome!</h5></b>
                                                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                                                                        <br>
                                                                                                        <table class="button swu-button"><tr><td><table><tr><td><a href="#">Click le Button</a></td></tr></table></td></tr></table>
                                                                                                    </th>
                                                                                                    <th class="expander"></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr></tbody></table>
                                                                                    <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                                                                                <th class="small-12 large-12 columns first last">
                                                                                                    <table>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                &#xA0; 
                                                                                                            </th>
                                                                                                            <th class="expander"></th>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </th>
                                                                                            </tr></tbody></table>
                                                </td></tr></tbody></table>  <!-- end main email content --> 

                                                <table class="container text-center"><tbody><tr><td> <!-- footer -->
                                                                <table class="row grey"><tbody><tr>
                                                                            <th class="small-12 large-12 columns first last">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="text-center footercopy">&#xA9; Copyright 2016 Sendwithus. All Rights Reserved.</p>
                                                                                        </th>
                                                                                        <th class="expander"></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr></tbody></table>
                                                            </td></tr></tbody></table>  



                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>',
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
<style type="text/css">
    #outlook a {padding: 0; }
    body {
        width: 100% !important;
        min-width: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        margin: 0;
        Margin: 0;
        padding: 0;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box; }

    .ExternalClass {
        width: 100%; }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
            line-height: 100%; }

    #backgroundTable {
        margin: 0;
        Margin: 0;
        padding: 0;
        width: 100% !important;
        line-height: 100% !important; }

    img {
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        width: auto;
        max-width: 100%;
        clear: both;
        display: block; }

    center {
        width: 100%;
        min-width: 580px; }

    a img {
        border: none; }

    p {
        margin: 0 0 0 10px;
        Margin: 0 0 0 10px; }

    table {
        border-spacing: 0;
        border-collapse: collapse; }

    td {
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
        border-collapse: collapse !important; }

    table, tr, td {
        padding: 0;
        vertical-align: top;
        text-align: left; }

    html {
        min-height: 100%;
        background: #f0f0f0; }

    table.body {
        background: #f0f0f0;
        height: 100%;
        width: 100%; }

    table.container {
        background: #fefefe;
        width: 580px;
        margin: 0 auto;
        Margin: 0 auto;
        text-align: inherit; }

    table.row {
        padding: 0;
        width: 100%;
        position: relative; }

    table.container table.row {
        display: table; }

    td.columns,
    td.column,
    th.columns,
    th.column {
        margin: 0 auto;
        Margin: 0 auto;
        padding-left: 16px;
        padding-bottom: 16px; }

    td.columns.last,
    td.column.last,
    th.columns.last,
    th.column.last {
        padding-right: 16px; }

    td.columns table,
    td.column table,
    th.columns table,
    th.column table {
        width: 100%; }

    td.large-1,
    th.large-1 {
        width: 32.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-1.first,
    th.large-1.first {
        padding-left: 16px; }

    td.large-1.last,
    th.large-1.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-1,
    .collapse > tbody > tr > th.large-1 {
        padding-right: 0;
        padding-left: 0;
        width: 48.33333px; }

    .collapse td.large-1.first,
    .collapse th.large-1.first,
    .collapse td.large-1.last,
    .collapse th.large-1.last {
        width: 56.33333px; }

    td.large-2,
    th.large-2 {
        width: 80.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-2.first,
    th.large-2.first {
        padding-left: 16px; }

    td.large-2.last,
    th.large-2.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-2,
    .collapse > tbody > tr > th.large-2 {
        padding-right: 0;
        padding-left: 0;
        width: 96.66667px; }

    .collapse td.large-2.first,
    .collapse th.large-2.first,
    .collapse td.large-2.last,
    .collapse th.large-2.last {
        width: 104.66667px; }

    td.large-3,
    th.large-3 {
        width: 129px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-3.first,
    th.large-3.first {
        padding-left: 16px; }

    td.large-3.last,
    th.large-3.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-3,
    .collapse > tbody > tr > th.large-3 {
        padding-right: 0;
        padding-left: 0;
        width: 145px; }

    .collapse td.large-3.first,
    .collapse th.large-3.first,
    .collapse td.large-3.last,
    .collapse th.large-3.last {
        width: 153px; }

    td.large-4,
    th.large-4 {
        width: 177.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-4.first,
    th.large-4.first {
        padding-left: 16px; }

    td.large-4.last,
    th.large-4.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-4,
    .collapse > tbody > tr > th.large-4 {
        padding-right: 0;
        padding-left: 0;
        width: 193.33333px; }

    .collapse td.large-4.first,
    .collapse th.large-4.first,
    .collapse td.large-4.last,
    .collapse th.large-4.last {
        width: 201.33333px; }

    td.large-5,
    th.large-5 {
        width: 225.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-5.first,
    th.large-5.first {
        padding-left: 16px; }

    td.large-5.last,
    th.large-5.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-5,
    .collapse > tbody > tr > th.large-5 {
        padding-right: 0;
        padding-left: 0;
        width: 241.66667px; }

    .collapse td.large-5.first,
    .collapse th.large-5.first,
    .collapse td.large-5.last,
    .collapse th.large-5.last {
        width: 249.66667px; }

    td.large-6,
    th.large-6 {
        width: 274px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-6.first,
    th.large-6.first {
        padding-left: 16px; }

    td.large-6.last,
    th.large-6.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-6,
    .collapse > tbody > tr > th.large-6 {
        padding-right: 0;
        padding-left: 0;
        width: 290px; }

    .collapse td.large-6.first,
    .collapse th.large-6.first,
    .collapse td.large-6.last,
    .collapse th.large-6.last {
        width: 298px; }

    td.large-7,
    th.large-7 {
        width: 322.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-7.first,
    th.large-7.first {
        padding-left: 16px; }

    td.large-7.last,
    th.large-7.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-7,
    .collapse > tbody > tr > th.large-7 {
        padding-right: 0;
        padding-left: 0;
        width: 338.33333px; }

    .collapse td.large-7.first,
    .collapse th.large-7.first,
    .collapse td.large-7.last,
    .collapse th.large-7.last {
        width: 346.33333px; }

    td.large-8,
    th.large-8 {
        width: 370.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-8.first,
    th.large-8.first {
        padding-left: 16px; }

    td.large-8.last,
    th.large-8.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-8,
    .collapse > tbody > tr > th.large-8 {
        padding-right: 0;
        padding-left: 0;
        width: 386.66667px; }

    .collapse td.large-8.first,
    .collapse th.large-8.first,
    .collapse td.large-8.last,
    .collapse th.large-8.last {
        width: 394.66667px; }

    td.large-9,
    th.large-9 {
        width: 419px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-9.first,
    th.large-9.first {
        padding-left: 16px; }

    td.large-9.last,
    th.large-9.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-9,
    .collapse > tbody > tr > th.large-9 {
        padding-right: 0;
        padding-left: 0;
        width: 435px; }

    .collapse td.large-9.first,
    .collapse th.large-9.first,
    .collapse td.large-9.last,
    .collapse th.large-9.last {
        width: 443px; }

    td.large-10,
    th.large-10 {
        width: 467.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-10.first,
    th.large-10.first {
        padding-left: 16px; }

    td.large-10.last,
    th.large-10.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-10,
    .collapse > tbody > tr > th.large-10 {
        padding-right: 0;
        padding-left: 0;
        width: 483.33333px; }

    .collapse td.large-10.first,
    .collapse th.large-10.first,
    .collapse td.large-10.last,
    .collapse th.large-10.last {
        width: 491.33333px; }

    td.large-11,
    th.large-11 {
        width: 515.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-11.first,
    th.large-11.first {
        padding-left: 16px; }

    td.large-11.last,
    th.large-11.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-11,
    .collapse > tbody > tr > th.large-11 {
        padding-right: 0;
        padding-left: 0;
        width: 531.66667px; }

    .collapse td.large-11.first,
    .collapse th.large-11.first,
    .collapse td.large-11.last,
    .collapse th.large-11.last {
        width: 539.66667px; }

    td.large-12,
    th.large-12 {
        width: 564px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-12.first,
    th.large-12.first {
        padding-left: 16px; }

    td.large-12.last,
    th.large-12.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-12,
    .collapse > tbody > tr > th.large-12 {
        padding-right: 0;
        padding-left: 0;
        width: 580px; }

    .collapse td.large-12.first,
    .collapse th.large-12.first,
    .collapse td.large-12.last,
    .collapse th.large-12.last {
        width: 588px; }

    td.large-1 center,
    th.large-1 center {
        min-width: 0.33333px; }

    td.large-2 center,
    th.large-2 center {
        min-width: 48.66667px; }

    td.large-3 center,
    th.large-3 center {
        min-width: 97px; }

    td.large-4 center,
    th.large-4 center {
        min-width: 145.33333px; }

    td.large-5 center,
    th.large-5 center {
        min-width: 193.66667px; }

    td.large-6 center,
    th.large-6 center {
        min-width: 242px; }

    td.large-7 center,
    th.large-7 center {
        min-width: 290.33333px; }

    td.large-8 center,
    th.large-8 center {
        min-width: 338.66667px; }

    td.large-9 center,
    th.large-9 center {
        min-width: 387px; }

    td.large-10 center,
    th.large-10 center {
        min-width: 435.33333px; }

    td.large-11 center,
    th.large-11 center {
        min-width: 483.66667px; }

    td.large-12 center,
    th.large-12 center {
        min-width: 532px; }

    .body .columns td.large-1,
    .body .column td.large-1,
    .body .columns th.large-1,
    .body .column th.large-1 {
        width: 8.33333%; }

    .body .columns td.large-2,
    .body .column td.large-2,
    .body .columns th.large-2,
    .body .column th.large-2 {
        width: 16.66667%; }

    .body .columns td.large-3,
    .body .column td.large-3,
    .body .columns th.large-3,
    .body .column th.large-3 {
        width: 25%; }

    .body .columns td.large-4,
    .body .column td.large-4,
    .body .columns th.large-4,
    .body .column th.large-4 {
        width: 33.33333%; }

    .body .columns td.large-5,
    .body .column td.large-5,
    .body .columns th.large-5,
    .body .column th.large-5 {
        width: 41.66667%; }

    .body .columns td.large-6,
    .body .column td.large-6,
    .body .columns th.large-6,
    .body .column th.large-6 {
        width: 50%; }

    .body .columns td.large-7,
    .body .column td.large-7,
    .body .columns th.large-7,
    .body .column th.large-7 {
        width: 58.33333%; }

    .body .columns td.large-8,
    .body .column td.large-8,
    .body .columns th.large-8,
    .body .column th.large-8 {
        width: 66.66667%; }

    .body .columns td.large-9,
    .body .column td.large-9,
    .body .columns th.large-9,
    .body .column th.large-9 {
        width: 75%; }

    .body .columns td.large-10,
    .body .column td.large-10,
    .body .columns th.large-10,
    .body .column th.large-10 {
        width: 83.33333%; }

    .body .columns td.large-11,
    .body .column td.large-11,
    .body .columns th.large-11,
    .body .column th.large-11 {
        width: 91.66667%; }

    .body .columns td.large-12,
    .body .column td.large-12,
    .body .columns th.large-12,
    .body .column th.large-12 {
        width: 100%; }

    td.large-offset-1,
    td.large-offset-1.first,
    td.large-offset-1.last,
    th.large-offset-1,
    th.large-offset-1.first,
    th.large-offset-1.last {
        padding-left: 64.33333px; }

    td.large-offset-2,
    td.large-offset-2.first,
    td.large-offset-2.last,
    th.large-offset-2,
    th.large-offset-2.first,
    th.large-offset-2.last {
        padding-left: 112.66667px; }

    td.large-offset-3,
    td.large-offset-3.first,
    td.large-offset-3.last,
    th.large-offset-3,
    th.large-offset-3.first,
    th.large-offset-3.last {
        padding-left: 161px; }

    td.large-offset-4,
    td.large-offset-4.first,
    td.large-offset-4.last,
    th.large-offset-4,
    th.large-offset-4.first,
    th.large-offset-4.last {
        padding-left: 209.33333px; }

    td.large-offset-5,
    td.large-offset-5.first,
    td.large-offset-5.last,
    th.large-offset-5,
    th.large-offset-5.first,
    th.large-offset-5.last {
        padding-left: 257.66667px; }

    td.large-offset-6,
    td.large-offset-6.first,
    td.large-offset-6.last,
    th.large-offset-6,
    th.large-offset-6.first,
    th.large-offset-6.last {
        padding-left: 306px; }

    td.large-offset-7,
    td.large-offset-7.first,
    td.large-offset-7.last,
    th.large-offset-7,
    th.large-offset-7.first,
    th.large-offset-7.last {
        padding-left: 354.33333px; }

    td.large-offset-8,
    td.large-offset-8.first,
    td.large-offset-8.last,
    th.large-offset-8,
    th.large-offset-8.first,
    th.large-offset-8.last {
        padding-left: 402.66667px; }

    td.large-offset-9,
    td.large-offset-9.first,
    td.large-offset-9.last,
    th.large-offset-9,
    th.large-offset-9.first,
    th.large-offset-9.last {
        padding-left: 451px; }

    td.large-offset-10,
    td.large-offset-10.first,
    td.large-offset-10.last,
    th.large-offset-10,
    th.large-offset-10.first,
    th.large-offset-10.last {
        padding-left: 499.33333px; }

    td.large-offset-11,
    td.large-offset-11.first,
    td.large-offset-11.last,
    th.large-offset-11,
    th.large-offset-11.first,
    th.large-offset-11.last {
        padding-left: 547.66667px; }

    td.expander,
    th.expander {
        visibility: hidden;
        width: 0;
        padding: 0 !important; }

    .block-grid {
        width: 100%;
        max-width: 580px; }
    .block-grid td {
        display: inline-block;
        padding: 8px; }

    .up-2 td {
        width: 274px !important; }

    .up-3 td {
        width: 177px !important; }

    .up-4 td {
        width: 129px !important; }

    .up-5 td {
        width: 100px !important; }

    .up-6 td {
        width: 80px !important; }

    .up-7 td {
        width: 66px !important; }

    .up-8 td {
        width: 56px !important; }

    table.text-center,
    td.text-center,
    h1.text-center,
    h2.text-center,
    h3.text-center,
    h4.text-center,
    h5.text-center,
    h6.text-center,
    p.text-center,
    span.text-center {
        text-align: center; }

    h1.text-left,
    h2.text-left,
    h3.text-left,
    h4.text-left,
    h5.text-left,
    h6.text-left,
    p.text-left,
    span.text-left {
        text-align: left; }

    h1.text-right,
    h2.text-right,
    h3.text-right,
    h4.text-right,
    h5.text-right,
    h6.text-right,
    p.text-right,
    span.text-right {
        text-align: right; }

    span.text-center {
        display: block;
        width: 100%;
        text-align: center; }

    img.float-left {
        float: left;
        text-align: left; }

    img.float-right {
        float: right;
        text-align: right; }

    img.float-center,
    img.text-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.float-center,
    td.float-center,
    th.float-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.body table.container .hide-for-large {
        display: none;
        width: 0;
        mso-hide: all;
        overflow: hidden;
        max-height: 0px;
        font-size: 0;
        width: 0px;
        line-height: 0; }

    body,
    table.body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    td,
    th,
    a {
        color: #0a0a0a;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        padding: 0;
        margin: 0;
        Margin: 0;
        text-align: left;
        line-height: 1.3; }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: inherit;
        word-wrap: normal;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        margin-bottom: 10px;
        Margin-bottom: 10px; }

    h1 {
        font-size: 34px; }

    h2 {
        font-size: 30px; }

    h3 {
        font-size: 28px; }

    h4 {
        font-size: 24px; }

    h5 {
        font-size: 20px; }

    h6 {
        font-size: 18px; }

    body,
    table.body,
    p,
    td,
    th {
        font-size: 15px;
        line-height: 19px; }

    p {
        margin-bottom: 10px;
        Margin-bottom: 10px; }
    p.lead {
        font-size: 18.75px;
        line-height: 1.6; }
    p.subheader {
        margin-top: 4px;
        margin-bottom: 8px;
        Margin-top: 4px;
        Margin-bottom: 8px;
        font-weight: normal;
        line-height: 1.4;
        color: #8a8a8a; }

    small {
        font-size: 80%;
        color: #cacaca; }

    a {
        color: #f7931d;
        text-decoration: none; }
    a:hover {
        color: #d97908; }
    a:active {
        color: #d97908; }
    a:visited {
        color: #f7931d; }

    h1 a,
    h1 a:visited,
    h2 a,
    h2 a:visited,
    h3 a,
    h3 a:visited,
    h4 a,
    h4 a:visited,
    h5 a,
    h5 a:visited,
    h6 a,
    h6 a:visited {
        color: #f7931d; }

    pre {
        background: #f0f0f0;
        margin: 30px 0;
        Margin: 30px 0; }
    pre code {
        color: #cacaca; }
        pre code span.callout {
            color: #8a8a8a;
            font-weight: bold; }
    pre code span.callout-strong {
        color: #ff6908;
        font-weight: bold; }

    hr {
        max-width: 580px;
        height: 0;
        border-right: 0;
        border-top: 0;
        border-bottom: 1px solid #cacaca;
        border-left: 0;
        margin: 20px auto;
        Margin: 20px auto;
        clear: both; }

    .stat {
        font-size: 40px;
        line-height: 1; }
    p + .stat {
        margin-top: -16px;
        Margin-top: -16px; }

    table.button {
        width: auto !important;
        margin: 0 0 16px 0;
        Margin: 0 0 16px 0; }
    table.button table td {
        width: auto !important;
        text-align: left;
        color: #fefefe;
        background: #f7931d;
        border: 2px solid #f7931d; }
        table.button table td.radius {
            border-radius: 3px; }
    table.button table td.rounded {
        border-radius: 500px; }
        table.button table td a {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #fefefe;
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px 8px 16px;
            border: 0px solid #f7931d;
            border-radius: 3px; }

    table.button:hover table tr td a,
    table.button:active table tr td a,
    table.button table tr td a:visited,
    table.button.tiny:hover table tr td a,
    table.button.tiny:active table tr td a,
    table.button.tiny table tr td a:visited,
    table.button.small:hover table tr td a,
    table.button.small:active table tr td a,
    table.button.small table tr td a:visited,
    table.button.large:hover table tr td a,
    table.button.large:active table tr td a,
    table.button.large table tr td a:visited {
        color: #fefefe; }

    table.button.tiny table td,
    table.button.tiny table a {
        padding: 4px 8px 4px 8px; }

    table.button.tiny table a {
        font-size: 10px;
        font-weight: normal; }

    table.button.small table td,
    table.button.small table a {
        padding: 5px 10px 5px 10px;
        font-size: 12px; }

    table.button.large table a {
        padding: 10px 20px 10px 20px;
        font-size: 20px; }

    table.expand,
    table.expanded {
        width: 100% !important; }
    table.expand table,
    table.expanded table {
        width: 100%; }
        table.expand table a,
        table.expanded table a {
            text-align: center; }
    table.expand center,
    table.expanded center {
        min-width: 0; }

    table.button:hover table td,
    table.button:visited table td,
    table.button:active table td {
        background: #d97908;
        color: #fefefe; }

    table.button:hover table a,
    table.button:visited table a,
    table.button:active table a {
        border: 0px solid #d97908; }

    table.button.secondary table td {
        background: #777777;
        color: #fefefe;
        border: 2px solid #777777; }

    table.button.secondary table a {
        color: #fefefe;
        border: 0px solid #777777; }

    table.button.secondary:hover table td {
        background: #919191;
        color: #fefefe; }

    table.button.secondary:hover table a {
        border: 0px solid #919191; }

    table.button.secondary:hover table td a {
        color: #fefefe; }

    table.button.secondary:active table td a {
        color: #fefefe; }

    table.button.secondary table td a:visited {
        color: #fefefe; }

    table.button.success table td {
        background: #3adb76;
        border: 2px solid #3adb76; }

    table.button.success table a {
        border: 0px solid #3adb76; }

    table.button.success:hover table td {
        background: #23bf5d; }

    table.button.success:hover table a {
        border: 0px solid #23bf5d; }

    table.button.alert table td {
        background: #ec5840;
        border: 2px solid #ec5840; }

    table.button.alert table a {
        border: 0px solid #ec5840; }

    table.button.alert:hover table td {
        background: #e23317; }

    table.button.alert:hover table a {
        border: 0px solid #e23317; }

    table.callout {
        margin-bottom: 16px;
        Margin-bottom: 16px; }

    th.callout-inner {
        width: 100%;
        border: 1px solid #cbcbcb;
        padding: 10px;
        background: #fefefe; }
    th.callout-inner.primary {
        background: #feefdd;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.secondary {
        background: #ebebeb;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.success {
        background: #e1faea;
        border: 1px solid #1b9448;
        color: #fefefe; }
    th.callout-inner.warning {
        background: #fff3d9;
        border: 1px solid #996800;
        color: #fefefe; }
    th.callout-inner.alert {
        background: #fce6e2;
        border: 1px solid #b42912;
        color: #fefefe; }

    .thumbnail {
        border: solid 4px #fefefe;
        box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
        display: inline-block;
        line-height: 0;
        max-width: 100%;
        transition: box-shadow 200ms ease-out;
        border-radius: 3px;
        margin-bottom: 16px; }
    .thumbnail:hover, .thumbnail:focus {
        box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

    table.menu {
        width: 580px; }
    table.menu td.menu-item,
    table.menu th.menu-item {
        padding: 10px;
        padding-right: 10px; }
        table.menu td.menu-item a,
        table.menu th.menu-item a {
            color: #f7931d; }

    table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item {
        padding: 10px;
        padding-right: 0;
        display: block; }
    table.menu.vertical td.menu-item a,
    table.menu.vertical th.menu-item a {
        width: 100%; }

    table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
        padding-left: 10px; }

    table.menu.text-center a {
        text-align: center; }

    .menu[align="center"] {
        width: auto !important; }

    body.outlook p {
        display: inline !important; }



    .footer-drip {
        background: #F3F3F3;
        border-radius: 0 0 10px 10px; }

    .footer-drip .columns {
        padding-top: 16px; }

    .container.header-drip {
        background: #F3F3F3; }

    .container.header-drip .columns {
        padding-bottom: 16px;
        padding-top: 16px; }

    .container.body-drip {
        border-radius: 10px;
        border-top: 10px solid #663399; }

    .header {
        background: #8a8a8a; }

    .header p {
        color: #ffffff;
        margin: 0; }

    .header .columns {
        padding-bottom: 0; }

    .header .container {
        background: #8a8a8a;
        padding-top: 16px;
        padding-bottom: 16px; }

    .header .container td {
        padding-top: 16px;
        padding-bottom: 16px; }

    .grey {
        background: #f0f0f0; }

    .border-test {
        border: 1px solid #ccc; }

    .masthead {
        background: #212121; }

    .swu-logo {
        width: 170px;
        height: auto;
        padding: 15px 0px 0px 0px; }

    .masthead h1 {
        color: #f7931d;
        padding: 35px 0px 15px 0px; }

    .column-border {
        border: 1px solid #eee; }

    .footercopy {
        padding: 20px 0px;
        font-size: 12px;
        color: #777777; }

    p {
        color: #777777 !important; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .hide-for-large {
            display: block !important;
            width: auto !important;
            overflow: visible !important; } }

    table.body table.container .hide-for-large * {
        mso-hide: all; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .row.hide-for-large,
        table.body table.container .row.hide-for-large {
            display: table !important;
            width: 100% !important; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .show-for-large {
            display: none !important;
            width: 0;
            mso-hide: all;
            overflow: hidden; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body img {
            width: auto !important;
            height: auto !important; }
    table.body center {
        min-width: 0 !important; }
    table.body .container {
        width: 95% !important; }
    table.body .columns,
    table.body .column {
        height: auto !important;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding-left: 16px !important;
        padding-right: 16px !important; }
        table.body .columns .column,
        table.body .columns .columns,
        table.body .column .column,
        table.body .column .columns {
            padding-left: 0 !important;
            padding-right: 0 !important; }
    table.body .collapse .columns,
    table.body .collapse .column {
        padding-left: 0 !important;
        padding-right: 0 !important; }
    td.small-1,
    th.small-1 {
        display: inline-block !important;
        width: 8.33333% !important; }
    td.small-2,
    th.small-2 {
        display: inline-block !important;
        width: 16.66667% !important; }
    td.small-3,
    th.small-3 {
        display: inline-block !important;
        width: 25% !important; }
    td.small-4,
    th.small-4 {
        display: inline-block !important;
        width: 33.33333% !important; }
    td.small-5,
    th.small-5 {
        display: inline-block !important;
        width: 41.66667% !important; }
    td.small-6,
    th.small-6 {
        display: inline-block !important;
        width: 50% !important; }
    td.small-7,
    th.small-7 {
        display: inline-block !important;
        width: 58.33333% !important; }
    td.small-8,
    th.small-8 {
        display: inline-block !important;
        width: 66.66667% !important; }
    td.small-9,
    th.small-9 {
        display: inline-block !important;
        width: 75% !important; }
    td.small-10,
    th.small-10 {
        display: inline-block !important;
        width: 83.33333% !important; }
    td.small-11,
    th.small-11 {
        display: inline-block !important;
        width: 91.66667% !important; }
    td.small-12,
    th.small-12 {
        display: inline-block !important;
        width: 100% !important; }
    .columns td.small-12,
    .column td.small-12,
    .columns th.small-12,
    .column th.small-12 {
        display: block !important;
        width: 100% !important; }
    .body .columns td.small-1,
    .body .column td.small-1,
    td.small-1 center,
    .body .columns th.small-1,
    .body .column th.small-1,
    th.small-1 center {
        display: inline-block !important;
        width: 8.33333% !important; }
    .body .columns td.small-2,
    .body .column td.small-2,
    td.small-2 center,
    .body .columns th.small-2,
    .body .column th.small-2,
    th.small-2 center {
        display: inline-block !important;
        width: 16.66667% !important; }
    .body .columns td.small-3,
    .body .column td.small-3,
    td.small-3 center,
    .body .columns th.small-3,
    .body .column th.small-3,
    th.small-3 center {
        display: inline-block !important;
        width: 25% !important; }
    .body .columns td.small-4,
    .body .column td.small-4,
    td.small-4 center,
    .body .columns th.small-4,
    .body .column th.small-4,
    th.small-4 center {
        display: inline-block !important;
        width: 33.33333% !important; }
    .body .columns td.small-5,
    .body .column td.small-5,
    td.small-5 center,
    .body .columns th.small-5,
    .body .column th.small-5,
    th.small-5 center {
        display: inline-block !important;
        width: 41.66667% !important; }
    .body .columns td.small-6,
    .body .column td.small-6,
    td.small-6 center,
    .body .columns th.small-6,
    .body .column th.small-6,
    th.small-6 center {
        display: inline-block !important;
        width: 50% !important; }
    .body .columns td.small-7,
    .body .column td.small-7,
    td.small-7 center,
    .body .columns th.small-7,
    .body .column th.small-7,
    th.small-7 center {
        display: inline-block !important;
        width: 58.33333% !important; }
    .body .columns td.small-8,
    .body .column td.small-8,
    td.small-8 center,
    .body .columns th.small-8,
    .body .column th.small-8,
    th.small-8 center {
        display: inline-block !important;
        width: 66.66667% !important; }
    .body .columns td.small-9,
    .body .column td.small-9,
    td.small-9 center,
    .body .columns th.small-9,
    .body .column th.small-9,
    th.small-9 center {
        display: inline-block !important;
        width: 75% !important; }
    .body .columns td.small-10,
    .body .column td.small-10,
    td.small-10 center,
    .body .columns th.small-10,
    .body .column th.small-10,
    th.small-10 center {
        display: inline-block !important;
        width: 83.33333% !important; }
    .body .columns td.small-11,
    .body .column td.small-11,
    td.small-11 center,
    .body .columns th.small-11,
    .body .column th.small-11,
    th.small-11 center {
        display: inline-block !important;
        width: 91.66667% !important; }
    table.body td.small-offset-1,
    table.body th.small-offset-1 {
        margin-left: 8.33333% !important;
        Margin-left: 8.33333% !important; }
    table.body td.small-offset-2,
    table.body th.small-offset-2 {
        margin-left: 16.66667% !important;
        Margin-left: 16.66667% !important; }
    table.body td.small-offset-3,
    table.body th.small-offset-3 {
        margin-left: 25% !important;
        Margin-left: 25% !important; }
    table.body td.small-offset-4,
    table.body th.small-offset-4 {
        margin-left: 33.33333% !important;
        Margin-left: 33.33333% !important; }
    table.body td.small-offset-5,
    table.body th.small-offset-5 {
        margin-left: 41.66667% !important;
        Margin-left: 41.66667% !important; }
    table.body td.small-offset-6,
    table.body th.small-offset-6 {
        margin-left: 50% !important;
        Margin-left: 50% !important; }
    table.body td.small-offset-7,
    table.body th.small-offset-7 {
        margin-left: 58.33333% !important;
        Margin-left: 58.33333% !important; }
    table.body td.small-offset-8,
    table.body th.small-offset-8 {
        margin-left: 66.66667% !important;
        Margin-left: 66.66667% !important; }
    table.body td.small-offset-9,
    table.body th.small-offset-9 {
        margin-left: 75% !important;
        Margin-left: 75% !important; }
    table.body td.small-offset-10,
    table.body th.small-offset-10 {
        margin-left: 83.33333% !important;
        Margin-left: 83.33333% !important; }
    table.body td.small-offset-11,
    table.body th.small-offset-11 {
        margin-left: 91.66667% !important;
        Margin-left: 91.66667% !important; }
    table.body table.columns td.expander,
    table.body table.columns th.expander {
        display: none !important; }
    table.body .right-text-pad,
    table.body .text-pad-right {
        padding-left: 10px !important; }
    table.body .left-text-pad,
    table.body .text-pad-left {
        padding-right: 10px !important; }
    table.menu {
        width: 100% !important; }
        table.menu td,
        table.menu th {
            width: auto !important;
            display: inline-block !important; }
    table.menu.vertical td,
    table.menu.vertical th, table.menu.small-vertical td,
    table.menu.small-vertical th {
        display: block !important; }
    table.menu[align="center"] {
        width: auto !important; }
    table.button.expand {
        width: 100% !important; }
    }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        .small-float-center {
            margin: 0 auto !important;
            float: none !important;
            text-align: center !important; }
        .small-text-center {
            text-align: center !important; }
        .small-text-left {
        text-align: left !important; }
        .small-text-right {
        text-align: right !important; }
    }
</style>

    </head>
    <body>
        <table class="body">
            <tr>
                <td class="center" align="center" valign="top">
                    <center data-parsed="">
                        <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                                        <table class="row grey"><tbody><tr>
                                                    <th class="small-12 large-12 columns first last">
                                                        <table>
                                                            <tr>
                                                                <th>
                                                                    &#xA0; 
                                                                </th>
                                                                <th class="expander"></th>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr></tbody></table>
                                    </td></tr></tbody></table>

                                    <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                                                    <table class="row"><tbody><tr> <!-- Logo -->
                                                                <th class="small-12 large-12 columns first last">
                                                                    <table>
                                                                        <tr>
                                                                            <th>
                                                                                <center data-parsed="">
                                                                                    <a href="http://www.sendwithus.com" align="center" class="text-center">
                                                                                        <img src="https://www.sendwithus.com/assets/img/zurb-template-images/logo-placeholder.png" class="swu-logo">
                                                                                    </a>
                                                                                </center>
                                                                            </th>
                                                                            <th class="expander"></th>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr></tbody></table>
                                                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                                                        <th class="small-12 large-12 columns first last">
                                                                            <table>
                                                                                <tr>
                                                                                    <th>
                                                                                        <h1 class="text-center">Welcome Email!</h1>
                                                                                        <center data-parsed="">
                                                                                            <img src="https://www.sendwithus.com/assets/img/zurb-template-images/cat-placeholder.png" valign="bottom" align="center" class="text-center">
                                                                                        </center>
                                                                                    </th>
                                                                                    <th class="expander"></th>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                    </tr></tbody></table>
                                                                    <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                                                                <th class="small-12 large-12 columns first last">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <th>
                                                                                                &#xA0; 
                                                                                            </th>
                                                                                            <th class="expander"></th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </th>
                                                                            </tr></tbody></table>
                                                                            <table class="row"><tbody><tr> <!-- main Email content -->
                                                                                        <th class="small-12 large-12 columns first last">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <th>
                                                                                                        <b><h5>Welcome!</h5></b>
                                                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                                                                        <br>
                                                                                                        <table class="button swu-button"><tr><td><table><tr><td><a href="#">Click le Button</a></td></tr></table></td></tr></table>
                                                                                                    </th>
                                                                                                    <th class="expander"></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr></tbody></table>
                                                                                    <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                                                                                <th class="small-12 large-12 columns first last">
                                                                                                    <table>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                &#xA0; 
                                                                                                            </th>
                                                                                                            <th class="expander"></th>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </th>
                                                                                            </tr></tbody></table>
                                                </td></tr></tbody></table>  <!-- end main email content --> 

                                                <table class="container text-center"><tbody><tr><td> <!-- footer -->
                                                                <table class="row grey"><tbody><tr>
                                                                            <th class="small-12 large-12 columns first last">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="text-center footercopy">&#xA9; Copyright 2016 Sendwithus. All Rights Reserved.</p>
                                                                                        </th>
                                                                                        <th class="expander"></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr></tbody></table>
                                                            </td></tr></tbody></table>  



                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>'
            ],
            'title 2' => [
                'some description some description some description some description some description some description some description some description some description some description some description some description',
                'welcome.png',
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
<style type="text/css">
    #outlook a {padding: 0; }
    body {
        width: 100% !important;
        min-width: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        margin: 0;
        Margin: 0;
        padding: 0;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box; }

    .ExternalClass {
        width: 100%; }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
            line-height: 100%; }

    #backgroundTable {
        margin: 0;
        Margin: 0;
        padding: 0;
        width: 100% !important;
        line-height: 100% !important; }

    img {
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        width: auto;
        max-width: 100%;
        clear: both;
        display: block; }

    center {
        width: 100%;
        min-width: 580px; }

    a img {
        border: none; }

    p {
        margin: 0 0 0 10px;
        Margin: 0 0 0 10px; }

    table {
        border-spacing: 0;
        border-collapse: collapse; }

    td {
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
        border-collapse: collapse !important; }

    table, tr, td {
        padding: 0;
        vertical-align: top;
        text-align: left; }

    html {
        min-height: 100%;
        background: #f0f0f0; }

    table.body {
        background: #f0f0f0;
        height: 100%;
        width: 100%; }

    table.container {
        background: #fefefe;
        width: 580px;
        margin: 0 auto;
        Margin: 0 auto;
        text-align: inherit; }

    table.row {
        padding: 0;
        width: 100%;
        position: relative; }

    table.container table.row {
        display: table; }

    td.columns,
    td.column,
    th.columns,
    th.column {
        margin: 0 auto;
        Margin: 0 auto;
        padding-left: 16px;
        padding-bottom: 16px; }

    td.columns.last,
    td.column.last,
    th.columns.last,
    th.column.last {
        padding-right: 16px; }

    td.columns table,
    td.column table,
    th.columns table,
    th.column table {
        width: 100%; }

    td.large-1,
    th.large-1 {
        width: 32.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-1.first,
    th.large-1.first {
        padding-left: 16px; }

    td.large-1.last,
    th.large-1.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-1,
    .collapse > tbody > tr > th.large-1 {
        padding-right: 0;
        padding-left: 0;
        width: 48.33333px; }

    .collapse td.large-1.first,
    .collapse th.large-1.first,
    .collapse td.large-1.last,
    .collapse th.large-1.last {
        width: 56.33333px; }

    td.large-2,
    th.large-2 {
        width: 80.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-2.first,
    th.large-2.first {
        padding-left: 16px; }

    td.large-2.last,
    th.large-2.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-2,
    .collapse > tbody > tr > th.large-2 {
        padding-right: 0;
        padding-left: 0;
        width: 96.66667px; }

    .collapse td.large-2.first,
    .collapse th.large-2.first,
    .collapse td.large-2.last,
    .collapse th.large-2.last {
        width: 104.66667px; }

    td.large-3,
    th.large-3 {
        width: 129px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-3.first,
    th.large-3.first {
        padding-left: 16px; }

    td.large-3.last,
    th.large-3.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-3,
    .collapse > tbody > tr > th.large-3 {
        padding-right: 0;
        padding-left: 0;
        width: 145px; }

    .collapse td.large-3.first,
    .collapse th.large-3.first,
    .collapse td.large-3.last,
    .collapse th.large-3.last {
        width: 153px; }

    td.large-4,
    th.large-4 {
        width: 177.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-4.first,
    th.large-4.first {
        padding-left: 16px; }

    td.large-4.last,
    th.large-4.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-4,
    .collapse > tbody > tr > th.large-4 {
        padding-right: 0;
        padding-left: 0;
        width: 193.33333px; }

    .collapse td.large-4.first,
    .collapse th.large-4.first,
    .collapse td.large-4.last,
    .collapse th.large-4.last {
        width: 201.33333px; }

    td.large-5,
    th.large-5 {
        width: 225.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-5.first,
    th.large-5.first {
        padding-left: 16px; }

    td.large-5.last,
    th.large-5.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-5,
    .collapse > tbody > tr > th.large-5 {
        padding-right: 0;
        padding-left: 0;
        width: 241.66667px; }

    .collapse td.large-5.first,
    .collapse th.large-5.first,
    .collapse td.large-5.last,
    .collapse th.large-5.last {
        width: 249.66667px; }

    td.large-6,
    th.large-6 {
        width: 274px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-6.first,
    th.large-6.first {
        padding-left: 16px; }

    td.large-6.last,
    th.large-6.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-6,
    .collapse > tbody > tr > th.large-6 {
        padding-right: 0;
        padding-left: 0;
        width: 290px; }

    .collapse td.large-6.first,
    .collapse th.large-6.first,
    .collapse td.large-6.last,
    .collapse th.large-6.last {
        width: 298px; }

    td.large-7,
    th.large-7 {
        width: 322.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-7.first,
    th.large-7.first {
        padding-left: 16px; }

    td.large-7.last,
    th.large-7.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-7,
    .collapse > tbody > tr > th.large-7 {
        padding-right: 0;
        padding-left: 0;
        width: 338.33333px; }

    .collapse td.large-7.first,
    .collapse th.large-7.first,
    .collapse td.large-7.last,
    .collapse th.large-7.last {
        width: 346.33333px; }

    td.large-8,
    th.large-8 {
        width: 370.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-8.first,
    th.large-8.first {
        padding-left: 16px; }

    td.large-8.last,
    th.large-8.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-8,
    .collapse > tbody > tr > th.large-8 {
        padding-right: 0;
        padding-left: 0;
        width: 386.66667px; }

    .collapse td.large-8.first,
    .collapse th.large-8.first,
    .collapse td.large-8.last,
    .collapse th.large-8.last {
        width: 394.66667px; }

    td.large-9,
    th.large-9 {
        width: 419px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-9.first,
    th.large-9.first {
        padding-left: 16px; }

    td.large-9.last,
    th.large-9.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-9,
    .collapse > tbody > tr > th.large-9 {
        padding-right: 0;
        padding-left: 0;
        width: 435px; }

    .collapse td.large-9.first,
    .collapse th.large-9.first,
    .collapse td.large-9.last,
    .collapse th.large-9.last {
        width: 443px; }

    td.large-10,
    th.large-10 {
        width: 467.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-10.first,
    th.large-10.first {
        padding-left: 16px; }

    td.large-10.last,
    th.large-10.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-10,
    .collapse > tbody > tr > th.large-10 {
        padding-right: 0;
        padding-left: 0;
        width: 483.33333px; }

    .collapse td.large-10.first,
    .collapse th.large-10.first,
    .collapse td.large-10.last,
    .collapse th.large-10.last {
        width: 491.33333px; }

    td.large-11,
    th.large-11 {
        width: 515.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-11.first,
    th.large-11.first {
        padding-left: 16px; }

    td.large-11.last,
    th.large-11.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-11,
    .collapse > tbody > tr > th.large-11 {
        padding-right: 0;
        padding-left: 0;
        width: 531.66667px; }

    .collapse td.large-11.first,
    .collapse th.large-11.first,
    .collapse td.large-11.last,
    .collapse th.large-11.last {
        width: 539.66667px; }

    td.large-12,
    th.large-12 {
        width: 564px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-12.first,
    th.large-12.first {
        padding-left: 16px; }

    td.large-12.last,
    th.large-12.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-12,
    .collapse > tbody > tr > th.large-12 {
        padding-right: 0;
        padding-left: 0;
        width: 580px; }

    .collapse td.large-12.first,
    .collapse th.large-12.first,
    .collapse td.large-12.last,
    .collapse th.large-12.last {
        width: 588px; }

    td.large-1 center,
    th.large-1 center {
        min-width: 0.33333px; }

    td.large-2 center,
    th.large-2 center {
        min-width: 48.66667px; }

    td.large-3 center,
    th.large-3 center {
        min-width: 97px; }

    td.large-4 center,
    th.large-4 center {
        min-width: 145.33333px; }

    td.large-5 center,
    th.large-5 center {
        min-width: 193.66667px; }

    td.large-6 center,
    th.large-6 center {
        min-width: 242px; }

    td.large-7 center,
    th.large-7 center {
        min-width: 290.33333px; }

    td.large-8 center,
    th.large-8 center {
        min-width: 338.66667px; }

    td.large-9 center,
    th.large-9 center {
        min-width: 387px; }

    td.large-10 center,
    th.large-10 center {
        min-width: 435.33333px; }

    td.large-11 center,
    th.large-11 center {
        min-width: 483.66667px; }

    td.large-12 center,
    th.large-12 center {
        min-width: 532px; }

    .body .columns td.large-1,
    .body .column td.large-1,
    .body .columns th.large-1,
    .body .column th.large-1 {
        width: 8.33333%; }

    .body .columns td.large-2,
    .body .column td.large-2,
    .body .columns th.large-2,
    .body .column th.large-2 {
        width: 16.66667%; }

    .body .columns td.large-3,
    .body .column td.large-3,
    .body .columns th.large-3,
    .body .column th.large-3 {
        width: 25%; }

    .body .columns td.large-4,
    .body .column td.large-4,
    .body .columns th.large-4,
    .body .column th.large-4 {
        width: 33.33333%; }

    .body .columns td.large-5,
    .body .column td.large-5,
    .body .columns th.large-5,
    .body .column th.large-5 {
        width: 41.66667%; }

    .body .columns td.large-6,
    .body .column td.large-6,
    .body .columns th.large-6,
    .body .column th.large-6 {
        width: 50%; }

    .body .columns td.large-7,
    .body .column td.large-7,
    .body .columns th.large-7,
    .body .column th.large-7 {
        width: 58.33333%; }

    .body .columns td.large-8,
    .body .column td.large-8,
    .body .columns th.large-8,
    .body .column th.large-8 {
        width: 66.66667%; }

    .body .columns td.large-9,
    .body .column td.large-9,
    .body .columns th.large-9,
    .body .column th.large-9 {
        width: 75%; }

    .body .columns td.large-10,
    .body .column td.large-10,
    .body .columns th.large-10,
    .body .column th.large-10 {
        width: 83.33333%; }

    .body .columns td.large-11,
    .body .column td.large-11,
    .body .columns th.large-11,
    .body .column th.large-11 {
        width: 91.66667%; }

    .body .columns td.large-12,
    .body .column td.large-12,
    .body .columns th.large-12,
    .body .column th.large-12 {
        width: 100%; }

    td.large-offset-1,
    td.large-offset-1.first,
    td.large-offset-1.last,
    th.large-offset-1,
    th.large-offset-1.first,
    th.large-offset-1.last {
        padding-left: 64.33333px; }

    td.large-offset-2,
    td.large-offset-2.first,
    td.large-offset-2.last,
    th.large-offset-2,
    th.large-offset-2.first,
    th.large-offset-2.last {
        padding-left: 112.66667px; }

    td.large-offset-3,
    td.large-offset-3.first,
    td.large-offset-3.last,
    th.large-offset-3,
    th.large-offset-3.first,
    th.large-offset-3.last {
        padding-left: 161px; }

    td.large-offset-4,
    td.large-offset-4.first,
    td.large-offset-4.last,
    th.large-offset-4,
    th.large-offset-4.first,
    th.large-offset-4.last {
        padding-left: 209.33333px; }

    td.large-offset-5,
    td.large-offset-5.first,
    td.large-offset-5.last,
    th.large-offset-5,
    th.large-offset-5.first,
    th.large-offset-5.last {
        padding-left: 257.66667px; }

    td.large-offset-6,
    td.large-offset-6.first,
    td.large-offset-6.last,
    th.large-offset-6,
    th.large-offset-6.first,
    th.large-offset-6.last {
        padding-left: 306px; }

    td.large-offset-7,
    td.large-offset-7.first,
    td.large-offset-7.last,
    th.large-offset-7,
    th.large-offset-7.first,
    th.large-offset-7.last {
        padding-left: 354.33333px; }

    td.large-offset-8,
    td.large-offset-8.first,
    td.large-offset-8.last,
    th.large-offset-8,
    th.large-offset-8.first,
    th.large-offset-8.last {
        padding-left: 402.66667px; }

    td.large-offset-9,
    td.large-offset-9.first,
    td.large-offset-9.last,
    th.large-offset-9,
    th.large-offset-9.first,
    th.large-offset-9.last {
        padding-left: 451px; }

    td.large-offset-10,
    td.large-offset-10.first,
    td.large-offset-10.last,
    th.large-offset-10,
    th.large-offset-10.first,
    th.large-offset-10.last {
        padding-left: 499.33333px; }

    td.large-offset-11,
    td.large-offset-11.first,
    td.large-offset-11.last,
    th.large-offset-11,
    th.large-offset-11.first,
    th.large-offset-11.last {
        padding-left: 547.66667px; }

    td.expander,
    th.expander {
        visibility: hidden;
        width: 0;
        padding: 0 !important; }

    .block-grid {
        width: 100%;
        max-width: 580px; }
    .block-grid td {
        display: inline-block;
        padding: 8px; }

    .up-2 td {
        width: 274px !important; }

    .up-3 td {
        width: 177px !important; }

    .up-4 td {
        width: 129px !important; }

    .up-5 td {
        width: 100px !important; }

    .up-6 td {
        width: 80px !important; }

    .up-7 td {
        width: 66px !important; }

    .up-8 td {
        width: 56px !important; }

    table.text-center,
    td.text-center,
    h1.text-center,
    h2.text-center,
    h3.text-center,
    h4.text-center,
    h5.text-center,
    h6.text-center,
    p.text-center,
    span.text-center {
        text-align: center; }

    h1.text-left,
    h2.text-left,
    h3.text-left,
    h4.text-left,
    h5.text-left,
    h6.text-left,
    p.text-left,
    span.text-left {
        text-align: left; }

    h1.text-right,
    h2.text-right,
    h3.text-right,
    h4.text-right,
    h5.text-right,
    h6.text-right,
    p.text-right,
    span.text-right {
        text-align: right; }

    span.text-center {
        display: block;
        width: 100%;
        text-align: center; }

    img.float-left {
        float: left;
        text-align: left; }

    img.float-right {
        float: right;
        text-align: right; }

    img.float-center,
    img.text-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.float-center,
    td.float-center,
    th.float-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.body table.container .hide-for-large {
        display: none;
        width: 0;
        mso-hide: all;
        overflow: hidden;
        max-height: 0px;
        font-size: 0;
        width: 0px;
        line-height: 0; }

    body,
    table.body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    td,
    th,
    a {
        color: #0a0a0a;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        padding: 0;
        margin: 0;
        Margin: 0;
        text-align: left;
        line-height: 1.3; }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: inherit;
        word-wrap: normal;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        margin-bottom: 10px;
        Margin-bottom: 10px; }

    h1 {
        font-size: 34px; }

    h2 {
        font-size: 30px; }

    h3 {
        font-size: 28px; }

    h4 {
        font-size: 24px; }

    h5 {
        font-size: 20px; }

    h6 {
        font-size: 18px; }

    body,
    table.body,
    p,
    td,
    th {
        font-size: 15px;
        line-height: 19px; }

    p {
        margin-bottom: 10px;
        Margin-bottom: 10px; }
    p.lead {
        font-size: 18.75px;
        line-height: 1.6; }
    p.subheader {
        margin-top: 4px;
        margin-bottom: 8px;
        Margin-top: 4px;
        Margin-bottom: 8px;
        font-weight: normal;
        line-height: 1.4;
        color: #8a8a8a; }

    small {
        font-size: 80%;
        color: #cacaca; }

    a {
        color: #f7931d;
        text-decoration: none; }
    a:hover {
        color: #d97908; }
    a:active {
        color: #d97908; }
    a:visited {
        color: #f7931d; }

    h1 a,
    h1 a:visited,
    h2 a,
    h2 a:visited,
    h3 a,
    h3 a:visited,
    h4 a,
    h4 a:visited,
    h5 a,
    h5 a:visited,
    h6 a,
    h6 a:visited {
        color: #f7931d; }

    pre {
        background: #f0f0f0;
        margin: 30px 0;
        Margin: 30px 0; }
    pre code {
        color: #cacaca; }
        pre code span.callout {
            color: #8a8a8a;
            font-weight: bold; }
    pre code span.callout-strong {
        color: #ff6908;
        font-weight: bold; }

    hr {
        max-width: 580px;
        height: 0;
        border-right: 0;
        border-top: 0;
        border-bottom: 1px solid #cacaca;
        border-left: 0;
        margin: 20px auto;
        Margin: 20px auto;
        clear: both; }

    .stat {
        font-size: 40px;
        line-height: 1; }
    p + .stat {
        margin-top: -16px;
        Margin-top: -16px; }

    table.button {
        width: auto !important;
        margin: 0 0 16px 0;
        Margin: 0 0 16px 0; }
    table.button table td {
        width: auto !important;
        text-align: left;
        color: #fefefe;
        background: #f7931d;
        border: 2px solid #f7931d; }
        table.button table td.radius {
            border-radius: 3px; }
    table.button table td.rounded {
        border-radius: 500px; }
        table.button table td a {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #fefefe;
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px 8px 16px;
            border: 0px solid #f7931d;
            border-radius: 3px; }

    table.button:hover table tr td a,
    table.button:active table tr td a,
    table.button table tr td a:visited,
    table.button.tiny:hover table tr td a,
    table.button.tiny:active table tr td a,
    table.button.tiny table tr td a:visited,
    table.button.small:hover table tr td a,
    table.button.small:active table tr td a,
    table.button.small table tr td a:visited,
    table.button.large:hover table tr td a,
    table.button.large:active table tr td a,
    table.button.large table tr td a:visited {
        color: #fefefe; }

    table.button.tiny table td,
    table.button.tiny table a {
        padding: 4px 8px 4px 8px; }

    table.button.tiny table a {
        font-size: 10px;
        font-weight: normal; }

    table.button.small table td,
    table.button.small table a {
        padding: 5px 10px 5px 10px;
        font-size: 12px; }

    table.button.large table a {
        padding: 10px 20px 10px 20px;
        font-size: 20px; }

    table.expand,
    table.expanded {
        width: 100% !important; }
    table.expand table,
    table.expanded table {
        width: 100%; }
        table.expand table a,
        table.expanded table a {
            text-align: center; }
    table.expand center,
    table.expanded center {
        min-width: 0; }

    table.button:hover table td,
    table.button:visited table td,
    table.button:active table td {
        background: #d97908;
        color: #fefefe; }

    table.button:hover table a,
    table.button:visited table a,
    table.button:active table a {
        border: 0px solid #d97908; }

    table.button.secondary table td {
        background: #777777;
        color: #fefefe;
        border: 2px solid #777777; }

    table.button.secondary table a {
        color: #fefefe;
        border: 0px solid #777777; }

    table.button.secondary:hover table td {
        background: #919191;
        color: #fefefe; }

    table.button.secondary:hover table a {
        border: 0px solid #919191; }

    table.button.secondary:hover table td a {
        color: #fefefe; }

    table.button.secondary:active table td a {
        color: #fefefe; }

    table.button.secondary table td a:visited {
        color: #fefefe; }

    table.button.success table td {
        background: #3adb76;
        border: 2px solid #3adb76; }

    table.button.success table a {
        border: 0px solid #3adb76; }

    table.button.success:hover table td {
        background: #23bf5d; }

    table.button.success:hover table a {
        border: 0px solid #23bf5d; }

    table.button.alert table td {
        background: #ec5840;
        border: 2px solid #ec5840; }

    table.button.alert table a {
        border: 0px solid #ec5840; }

    table.button.alert:hover table td {
        background: #e23317; }

    table.button.alert:hover table a {
        border: 0px solid #e23317; }

    table.callout {
        margin-bottom: 16px;
        Margin-bottom: 16px; }

    th.callout-inner {
        width: 100%;
        border: 1px solid #cbcbcb;
        padding: 10px;
        background: #fefefe; }
    th.callout-inner.primary {
        background: #feefdd;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.secondary {
        background: #ebebeb;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.success {
        background: #e1faea;
        border: 1px solid #1b9448;
        color: #fefefe; }
    th.callout-inner.warning {
        background: #fff3d9;
        border: 1px solid #996800;
        color: #fefefe; }
    th.callout-inner.alert {
        background: #fce6e2;
        border: 1px solid #b42912;
        color: #fefefe; }

    .thumbnail {
        border: solid 4px #fefefe;
        box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
        display: inline-block;
        line-height: 0;
        max-width: 100%;
        transition: box-shadow 200ms ease-out;
        border-radius: 3px;
        margin-bottom: 16px; }
    .thumbnail:hover, .thumbnail:focus {
        box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

    table.menu {
        width: 580px; }
    table.menu td.menu-item,
    table.menu th.menu-item {
        padding: 10px;
        padding-right: 10px; }
        table.menu td.menu-item a,
        table.menu th.menu-item a {
            color: #f7931d; }

    table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item {
        padding: 10px;
        padding-right: 0;
        display: block; }
    table.menu.vertical td.menu-item a,
    table.menu.vertical th.menu-item a {
        width: 100%; }

    table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
        padding-left: 10px; }

    table.menu.text-center a {
        text-align: center; }

    .menu[align="center"] {
        width: auto !important; }

    body.outlook p {
        display: inline !important; }



    .footer-drip {
        background: #F3F3F3;
        border-radius: 0 0 10px 10px; }

    .footer-drip .columns {
        padding-top: 16px; }

    .container.header-drip {
        background: #F3F3F3; }

    .container.header-drip .columns {
        padding-bottom: 16px;
        padding-top: 16px; }

    .container.body-drip {
        border-radius: 10px;
        border-top: 10px solid #663399; }

    .header {
        background: #8a8a8a; }

    .header p {
        color: #ffffff;
        margin: 0; }

    .header .columns {
        padding-bottom: 0; }

    .header .container {
        background: #8a8a8a;
        padding-top: 16px;
        padding-bottom: 16px; }

    .header .container td {
        padding-top: 16px;
        padding-bottom: 16px; }

    .grey {
        background: #f0f0f0; }

    .border-test {
        border: 1px solid #ccc; }

    .masthead {
        background: #212121; }

    .swu-logo {
        width: 170px;
        height: auto;
        padding: 15px 0px 0px 0px; }

    .masthead h1 {
        color: #f7931d;
        padding: 35px 0px 15px 0px; }

    .column-border {
        border: 1px solid #eee; }

    .footercopy {
        padding: 20px 0px;
        font-size: 12px;
        color: #777777; }

    p {
        color: #777777 !important; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .hide-for-large {
            display: block !important;
            width: auto !important;
            overflow: visible !important; } }

    table.body table.container .hide-for-large * {
        mso-hide: all; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .row.hide-for-large,
        table.body table.container .row.hide-for-large {
            display: table !important;
            width: 100% !important; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .show-for-large {
            display: none !important;
            width: 0;
            mso-hide: all;
            overflow: hidden; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body img {
            width: auto !important;
            height: auto !important; }
    table.body center {
        min-width: 0 !important; }
    table.body .container {
        width: 95% !important; }
    table.body .columns,
    table.body .column {
        height: auto !important;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding-left: 16px !important;
        padding-right: 16px !important; }
        table.body .columns .column,
        table.body .columns .columns,
        table.body .column .column,
        table.body .column .columns {
            padding-left: 0 !important;
            padding-right: 0 !important; }
    table.body .collapse .columns,
    table.body .collapse .column {
        padding-left: 0 !important;
        padding-right: 0 !important; }
    td.small-1,
    th.small-1 {
        display: inline-block !important;
        width: 8.33333% !important; }
    td.small-2,
    th.small-2 {
        display: inline-block !important;
        width: 16.66667% !important; }
    td.small-3,
    th.small-3 {
        display: inline-block !important;
        width: 25% !important; }
    td.small-4,
    th.small-4 {
        display: inline-block !important;
        width: 33.33333% !important; }
    td.small-5,
    th.small-5 {
        display: inline-block !important;
        width: 41.66667% !important; }
    td.small-6,
    th.small-6 {
        display: inline-block !important;
        width: 50% !important; }
    td.small-7,
    th.small-7 {
        display: inline-block !important;
        width: 58.33333% !important; }
    td.small-8,
    th.small-8 {
        display: inline-block !important;
        width: 66.66667% !important; }
    td.small-9,
    th.small-9 {
        display: inline-block !important;
        width: 75% !important; }
    td.small-10,
    th.small-10 {
        display: inline-block !important;
        width: 83.33333% !important; }
    td.small-11,
    th.small-11 {
        display: inline-block !important;
        width: 91.66667% !important; }
    td.small-12,
    th.small-12 {
        display: inline-block !important;
        width: 100% !important; }
    .columns td.small-12,
    .column td.small-12,
    .columns th.small-12,
    .column th.small-12 {
        display: block !important;
        width: 100% !important; }
    .body .columns td.small-1,
    .body .column td.small-1,
    td.small-1 center,
    .body .columns th.small-1,
    .body .column th.small-1,
    th.small-1 center {
        display: inline-block !important;
        width: 8.33333% !important; }
    .body .columns td.small-2,
    .body .column td.small-2,
    td.small-2 center,
    .body .columns th.small-2,
    .body .column th.small-2,
    th.small-2 center {
        display: inline-block !important;
        width: 16.66667% !important; }
    .body .columns td.small-3,
    .body .column td.small-3,
    td.small-3 center,
    .body .columns th.small-3,
    .body .column th.small-3,
    th.small-3 center {
        display: inline-block !important;
        width: 25% !important; }
    .body .columns td.small-4,
    .body .column td.small-4,
    td.small-4 center,
    .body .columns th.small-4,
    .body .column th.small-4,
    th.small-4 center {
        display: inline-block !important;
        width: 33.33333% !important; }
    .body .columns td.small-5,
    .body .column td.small-5,
    td.small-5 center,
    .body .columns th.small-5,
    .body .column th.small-5,
    th.small-5 center {
        display: inline-block !important;
        width: 41.66667% !important; }
    .body .columns td.small-6,
    .body .column td.small-6,
    td.small-6 center,
    .body .columns th.small-6,
    .body .column th.small-6,
    th.small-6 center {
        display: inline-block !important;
        width: 50% !important; }
    .body .columns td.small-7,
    .body .column td.small-7,
    td.small-7 center,
    .body .columns th.small-7,
    .body .column th.small-7,
    th.small-7 center {
        display: inline-block !important;
        width: 58.33333% !important; }
    .body .columns td.small-8,
    .body .column td.small-8,
    td.small-8 center,
    .body .columns th.small-8,
    .body .column th.small-8,
    th.small-8 center {
        display: inline-block !important;
        width: 66.66667% !important; }
    .body .columns td.small-9,
    .body .column td.small-9,
    td.small-9 center,
    .body .columns th.small-9,
    .body .column th.small-9,
    th.small-9 center {
        display: inline-block !important;
        width: 75% !important; }
    .body .columns td.small-10,
    .body .column td.small-10,
    td.small-10 center,
    .body .columns th.small-10,
    .body .column th.small-10,
    th.small-10 center {
        display: inline-block !important;
        width: 83.33333% !important; }
    .body .columns td.small-11,
    .body .column td.small-11,
    td.small-11 center,
    .body .columns th.small-11,
    .body .column th.small-11,
    th.small-11 center {
        display: inline-block !important;
        width: 91.66667% !important; }
    table.body td.small-offset-1,
    table.body th.small-offset-1 {
        margin-left: 8.33333% !important;
        Margin-left: 8.33333% !important; }
    table.body td.small-offset-2,
    table.body th.small-offset-2 {
        margin-left: 16.66667% !important;
        Margin-left: 16.66667% !important; }
    table.body td.small-offset-3,
    table.body th.small-offset-3 {
        margin-left: 25% !important;
        Margin-left: 25% !important; }
    table.body td.small-offset-4,
    table.body th.small-offset-4 {
        margin-left: 33.33333% !important;
        Margin-left: 33.33333% !important; }
    table.body td.small-offset-5,
    table.body th.small-offset-5 {
        margin-left: 41.66667% !important;
        Margin-left: 41.66667% !important; }
    table.body td.small-offset-6,
    table.body th.small-offset-6 {
        margin-left: 50% !important;
        Margin-left: 50% !important; }
    table.body td.small-offset-7,
    table.body th.small-offset-7 {
        margin-left: 58.33333% !important;
        Margin-left: 58.33333% !important; }
    table.body td.small-offset-8,
    table.body th.small-offset-8 {
        margin-left: 66.66667% !important;
        Margin-left: 66.66667% !important; }
    table.body td.small-offset-9,
    table.body th.small-offset-9 {
        margin-left: 75% !important;
        Margin-left: 75% !important; }
    table.body td.small-offset-10,
    table.body th.small-offset-10 {
        margin-left: 83.33333% !important;
        Margin-left: 83.33333% !important; }
    table.body td.small-offset-11,
    table.body th.small-offset-11 {
        margin-left: 91.66667% !important;
        Margin-left: 91.66667% !important; }
    table.body table.columns td.expander,
    table.body table.columns th.expander {
        display: none !important; }
    table.body .right-text-pad,
    table.body .text-pad-right {
        padding-left: 10px !important; }
    table.body .left-text-pad,
    table.body .text-pad-left {
        padding-right: 10px !important; }
    table.menu {
        width: 100% !important; }
        table.menu td,
        table.menu th {
            width: auto !important;
            display: inline-block !important; }
    table.menu.vertical td,
    table.menu.vertical th, table.menu.small-vertical td,
    table.menu.small-vertical th {
        display: block !important; }
    table.menu[align="center"] {
        width: auto !important; }
    table.button.expand {
        width: 100% !important; }
    }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        .small-float-center {
            margin: 0 auto !important;
            float: none !important;
            text-align: center !important; }
        .small-text-center {
            text-align: center !important; }
        .small-text-left {
        text-align: left !important; }
        .small-text-right {
        text-align: right !important; }
    }
</style>

    </head>
    <body>
        <table class="body">
            <tr>
                <td class="center" align="center" valign="top">
                    <center data-parsed="">
                        <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                                        <table class="row grey"><tbody><tr>
                                                    <th class="small-12 large-12 columns first last">
                                                        <table>
                                                            <tr>
                                                                <th>
                                                                    &#xA0; 
                                                                </th>
                                                                <th class="expander"></th>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr></tbody></table>
                                    </td></tr></tbody></table>

                                    <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                                                    <table class="row"><tbody><tr> <!-- Logo -->
                                                                <th class="small-12 large-12 columns first last">
                                                                    <table>
                                                                        <tr>
                                                                            <th>
                                                                                <center data-parsed="">
                                                                                    <a href="http://www.sendwithus.com" align="center" class="text-center">
                                                                                        <img src="https://www.sendwithus.com/assets/img/zurb-template-images/logo-placeholder.png" class="swu-logo">
                                                                                    </a>
                                                                                </center>
                                                                            </th>
                                                                            <th class="expander"></th>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr></tbody></table>
                                                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                                                        <th class="small-12 large-12 columns first last">
                                                                            <table>
                                                                                <tr>
                                                                                    <th>
                                                                                        <h1 class="text-center">Welcome Email!</h1>
                                                                                        <center data-parsed="">
                                                                                            <img src="https://www.sendwithus.com/assets/img/zurb-template-images/cat-placeholder.png" valign="bottom" align="center" class="text-center">
                                                                                        </center>
                                                                                    </th>
                                                                                    <th class="expander"></th>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                    </tr></tbody></table>
                                                                    <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                                                                <th class="small-12 large-12 columns first last">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <th>
                                                                                                &#xA0; 
                                                                                            </th>
                                                                                            <th class="expander"></th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </th>
                                                                            </tr></tbody></table>
                                                                            <table class="row"><tbody><tr> <!-- main Email content -->
                                                                                        <th class="small-12 large-12 columns first last">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <th>
                                                                                                        <b><h5>Welcome!</h5></b>
                                                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                                                                        <br>
                                                                                                        <table class="button swu-button"><tr><td><table><tr><td><a href="#">Click le Button</a></td></tr></table></td></tr></table>
                                                                                                    </th>
                                                                                                    <th class="expander"></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr></tbody></table>
                                                                                    <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                                                                                <th class="small-12 large-12 columns first last">
                                                                                                    <table>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                &#xA0; 
                                                                                                            </th>
                                                                                                            <th class="expander"></th>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </th>
                                                                                            </tr></tbody></table>
                                                </td></tr></tbody></table>  <!-- end main email content --> 

                                                <table class="container text-center"><tbody><tr><td> <!-- footer -->
                                                                <table class="row grey"><tbody><tr>
                                                                            <th class="small-12 large-12 columns first last">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="text-center footercopy">&#xA9; Copyright 2016 Sendwithus. All Rights Reserved.</p>
                                                                                        </th>
                                                                                        <th class="expander"></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr></tbody></table>
                                                            </td></tr></tbody></table>  



                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>',
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
<style type="text/css">
    #outlook a {padding: 0; }
    body {
        width: 100% !important;
        min-width: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        margin: 0;
        Margin: 0;
        padding: 0;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box; }

    .ExternalClass {
        width: 100%; }
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
            line-height: 100%; }

    #backgroundTable {
        margin: 0;
        Margin: 0;
        padding: 0;
        width: 100% !important;
        line-height: 100% !important; }

    img {
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
        width: auto;
        max-width: 100%;
        clear: both;
        display: block; }

    center {
        width: 100%;
        min-width: 580px; }

    a img {
        border: none; }

    p {
        margin: 0 0 0 10px;
        Margin: 0 0 0 10px; }

    table {
        border-spacing: 0;
        border-collapse: collapse; }

    td {
        word-wrap: break-word;
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        hyphens: auto;
        border-collapse: collapse !important; }

    table, tr, td {
        padding: 0;
        vertical-align: top;
        text-align: left; }

    html {
        min-height: 100%;
        background: #f0f0f0; }

    table.body {
        background: #f0f0f0;
        height: 100%;
        width: 100%; }

    table.container {
        background: #fefefe;
        width: 580px;
        margin: 0 auto;
        Margin: 0 auto;
        text-align: inherit; }

    table.row {
        padding: 0;
        width: 100%;
        position: relative; }

    table.container table.row {
        display: table; }

    td.columns,
    td.column,
    th.columns,
    th.column {
        margin: 0 auto;
        Margin: 0 auto;
        padding-left: 16px;
        padding-bottom: 16px; }

    td.columns.last,
    td.column.last,
    th.columns.last,
    th.column.last {
        padding-right: 16px; }

    td.columns table,
    td.column table,
    th.columns table,
    th.column table {
        width: 100%; }

    td.large-1,
    th.large-1 {
        width: 32.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-1.first,
    th.large-1.first {
        padding-left: 16px; }

    td.large-1.last,
    th.large-1.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-1,
    .collapse > tbody > tr > th.large-1 {
        padding-right: 0;
        padding-left: 0;
        width: 48.33333px; }

    .collapse td.large-1.first,
    .collapse th.large-1.first,
    .collapse td.large-1.last,
    .collapse th.large-1.last {
        width: 56.33333px; }

    td.large-2,
    th.large-2 {
        width: 80.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-2.first,
    th.large-2.first {
        padding-left: 16px; }

    td.large-2.last,
    th.large-2.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-2,
    .collapse > tbody > tr > th.large-2 {
        padding-right: 0;
        padding-left: 0;
        width: 96.66667px; }

    .collapse td.large-2.first,
    .collapse th.large-2.first,
    .collapse td.large-2.last,
    .collapse th.large-2.last {
        width: 104.66667px; }

    td.large-3,
    th.large-3 {
        width: 129px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-3.first,
    th.large-3.first {
        padding-left: 16px; }

    td.large-3.last,
    th.large-3.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-3,
    .collapse > tbody > tr > th.large-3 {
        padding-right: 0;
        padding-left: 0;
        width: 145px; }

    .collapse td.large-3.first,
    .collapse th.large-3.first,
    .collapse td.large-3.last,
    .collapse th.large-3.last {
        width: 153px; }

    td.large-4,
    th.large-4 {
        width: 177.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-4.first,
    th.large-4.first {
        padding-left: 16px; }

    td.large-4.last,
    th.large-4.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-4,
    .collapse > tbody > tr > th.large-4 {
        padding-right: 0;
        padding-left: 0;
        width: 193.33333px; }

    .collapse td.large-4.first,
    .collapse th.large-4.first,
    .collapse td.large-4.last,
    .collapse th.large-4.last {
        width: 201.33333px; }

    td.large-5,
    th.large-5 {
        width: 225.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-5.first,
    th.large-5.first {
        padding-left: 16px; }

    td.large-5.last,
    th.large-5.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-5,
    .collapse > tbody > tr > th.large-5 {
        padding-right: 0;
        padding-left: 0;
        width: 241.66667px; }

    .collapse td.large-5.first,
    .collapse th.large-5.first,
    .collapse td.large-5.last,
    .collapse th.large-5.last {
        width: 249.66667px; }

    td.large-6,
    th.large-6 {
        width: 274px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-6.first,
    th.large-6.first {
        padding-left: 16px; }

    td.large-6.last,
    th.large-6.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-6,
    .collapse > tbody > tr > th.large-6 {
        padding-right: 0;
        padding-left: 0;
        width: 290px; }

    .collapse td.large-6.first,
    .collapse th.large-6.first,
    .collapse td.large-6.last,
    .collapse th.large-6.last {
        width: 298px; }

    td.large-7,
    th.large-7 {
        width: 322.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-7.first,
    th.large-7.first {
        padding-left: 16px; }

    td.large-7.last,
    th.large-7.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-7,
    .collapse > tbody > tr > th.large-7 {
        padding-right: 0;
        padding-left: 0;
        width: 338.33333px; }

    .collapse td.large-7.first,
    .collapse th.large-7.first,
    .collapse td.large-7.last,
    .collapse th.large-7.last {
        width: 346.33333px; }

    td.large-8,
    th.large-8 {
        width: 370.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-8.first,
    th.large-8.first {
        padding-left: 16px; }

    td.large-8.last,
    th.large-8.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-8,
    .collapse > tbody > tr > th.large-8 {
        padding-right: 0;
        padding-left: 0;
        width: 386.66667px; }

    .collapse td.large-8.first,
    .collapse th.large-8.first,
    .collapse td.large-8.last,
    .collapse th.large-8.last {
        width: 394.66667px; }

    td.large-9,
    th.large-9 {
        width: 419px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-9.first,
    th.large-9.first {
        padding-left: 16px; }

    td.large-9.last,
    th.large-9.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-9,
    .collapse > tbody > tr > th.large-9 {
        padding-right: 0;
        padding-left: 0;
        width: 435px; }

    .collapse td.large-9.first,
    .collapse th.large-9.first,
    .collapse td.large-9.last,
    .collapse th.large-9.last {
        width: 443px; }

    td.large-10,
    th.large-10 {
        width: 467.33333px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-10.first,
    th.large-10.first {
        padding-left: 16px; }

    td.large-10.last,
    th.large-10.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-10,
    .collapse > tbody > tr > th.large-10 {
        padding-right: 0;
        padding-left: 0;
        width: 483.33333px; }

    .collapse td.large-10.first,
    .collapse th.large-10.first,
    .collapse td.large-10.last,
    .collapse th.large-10.last {
        width: 491.33333px; }

    td.large-11,
    th.large-11 {
        width: 515.66667px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-11.first,
    th.large-11.first {
        padding-left: 16px; }

    td.large-11.last,
    th.large-11.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-11,
    .collapse > tbody > tr > th.large-11 {
        padding-right: 0;
        padding-left: 0;
        width: 531.66667px; }

    .collapse td.large-11.first,
    .collapse th.large-11.first,
    .collapse td.large-11.last,
    .collapse th.large-11.last {
        width: 539.66667px; }

    td.large-12,
    th.large-12 {
        width: 564px;
        padding-left: 8px;
        padding-right: 8px; }

    td.large-12.first,
    th.large-12.first {
        padding-left: 16px; }

    td.large-12.last,
    th.large-12.last {
        padding-right: 16px; }

    .collapse > tbody > tr > td.large-12,
    .collapse > tbody > tr > th.large-12 {
        padding-right: 0;
        padding-left: 0;
        width: 580px; }

    .collapse td.large-12.first,
    .collapse th.large-12.first,
    .collapse td.large-12.last,
    .collapse th.large-12.last {
        width: 588px; }

    td.large-1 center,
    th.large-1 center {
        min-width: 0.33333px; }

    td.large-2 center,
    th.large-2 center {
        min-width: 48.66667px; }

    td.large-3 center,
    th.large-3 center {
        min-width: 97px; }

    td.large-4 center,
    th.large-4 center {
        min-width: 145.33333px; }

    td.large-5 center,
    th.large-5 center {
        min-width: 193.66667px; }

    td.large-6 center,
    th.large-6 center {
        min-width: 242px; }

    td.large-7 center,
    th.large-7 center {
        min-width: 290.33333px; }

    td.large-8 center,
    th.large-8 center {
        min-width: 338.66667px; }

    td.large-9 center,
    th.large-9 center {
        min-width: 387px; }

    td.large-10 center,
    th.large-10 center {
        min-width: 435.33333px; }

    td.large-11 center,
    th.large-11 center {
        min-width: 483.66667px; }

    td.large-12 center,
    th.large-12 center {
        min-width: 532px; }

    .body .columns td.large-1,
    .body .column td.large-1,
    .body .columns th.large-1,
    .body .column th.large-1 {
        width: 8.33333%; }

    .body .columns td.large-2,
    .body .column td.large-2,
    .body .columns th.large-2,
    .body .column th.large-2 {
        width: 16.66667%; }

    .body .columns td.large-3,
    .body .column td.large-3,
    .body .columns th.large-3,
    .body .column th.large-3 {
        width: 25%; }

    .body .columns td.large-4,
    .body .column td.large-4,
    .body .columns th.large-4,
    .body .column th.large-4 {
        width: 33.33333%; }

    .body .columns td.large-5,
    .body .column td.large-5,
    .body .columns th.large-5,
    .body .column th.large-5 {
        width: 41.66667%; }

    .body .columns td.large-6,
    .body .column td.large-6,
    .body .columns th.large-6,
    .body .column th.large-6 {
        width: 50%; }

    .body .columns td.large-7,
    .body .column td.large-7,
    .body .columns th.large-7,
    .body .column th.large-7 {
        width: 58.33333%; }

    .body .columns td.large-8,
    .body .column td.large-8,
    .body .columns th.large-8,
    .body .column th.large-8 {
        width: 66.66667%; }

    .body .columns td.large-9,
    .body .column td.large-9,
    .body .columns th.large-9,
    .body .column th.large-9 {
        width: 75%; }

    .body .columns td.large-10,
    .body .column td.large-10,
    .body .columns th.large-10,
    .body .column th.large-10 {
        width: 83.33333%; }

    .body .columns td.large-11,
    .body .column td.large-11,
    .body .columns th.large-11,
    .body .column th.large-11 {
        width: 91.66667%; }

    .body .columns td.large-12,
    .body .column td.large-12,
    .body .columns th.large-12,
    .body .column th.large-12 {
        width: 100%; }

    td.large-offset-1,
    td.large-offset-1.first,
    td.large-offset-1.last,
    th.large-offset-1,
    th.large-offset-1.first,
    th.large-offset-1.last {
        padding-left: 64.33333px; }

    td.large-offset-2,
    td.large-offset-2.first,
    td.large-offset-2.last,
    th.large-offset-2,
    th.large-offset-2.first,
    th.large-offset-2.last {
        padding-left: 112.66667px; }

    td.large-offset-3,
    td.large-offset-3.first,
    td.large-offset-3.last,
    th.large-offset-3,
    th.large-offset-3.first,
    th.large-offset-3.last {
        padding-left: 161px; }

    td.large-offset-4,
    td.large-offset-4.first,
    td.large-offset-4.last,
    th.large-offset-4,
    th.large-offset-4.first,
    th.large-offset-4.last {
        padding-left: 209.33333px; }

    td.large-offset-5,
    td.large-offset-5.first,
    td.large-offset-5.last,
    th.large-offset-5,
    th.large-offset-5.first,
    th.large-offset-5.last {
        padding-left: 257.66667px; }

    td.large-offset-6,
    td.large-offset-6.first,
    td.large-offset-6.last,
    th.large-offset-6,
    th.large-offset-6.first,
    th.large-offset-6.last {
        padding-left: 306px; }

    td.large-offset-7,
    td.large-offset-7.first,
    td.large-offset-7.last,
    th.large-offset-7,
    th.large-offset-7.first,
    th.large-offset-7.last {
        padding-left: 354.33333px; }

    td.large-offset-8,
    td.large-offset-8.first,
    td.large-offset-8.last,
    th.large-offset-8,
    th.large-offset-8.first,
    th.large-offset-8.last {
        padding-left: 402.66667px; }

    td.large-offset-9,
    td.large-offset-9.first,
    td.large-offset-9.last,
    th.large-offset-9,
    th.large-offset-9.first,
    th.large-offset-9.last {
        padding-left: 451px; }

    td.large-offset-10,
    td.large-offset-10.first,
    td.large-offset-10.last,
    th.large-offset-10,
    th.large-offset-10.first,
    th.large-offset-10.last {
        padding-left: 499.33333px; }

    td.large-offset-11,
    td.large-offset-11.first,
    td.large-offset-11.last,
    th.large-offset-11,
    th.large-offset-11.first,
    th.large-offset-11.last {
        padding-left: 547.66667px; }

    td.expander,
    th.expander {
        visibility: hidden;
        width: 0;
        padding: 0 !important; }

    .block-grid {
        width: 100%;
        max-width: 580px; }
    .block-grid td {
        display: inline-block;
        padding: 8px; }

    .up-2 td {
        width: 274px !important; }

    .up-3 td {
        width: 177px !important; }

    .up-4 td {
        width: 129px !important; }

    .up-5 td {
        width: 100px !important; }

    .up-6 td {
        width: 80px !important; }

    .up-7 td {
        width: 66px !important; }

    .up-8 td {
        width: 56px !important; }

    table.text-center,
    td.text-center,
    h1.text-center,
    h2.text-center,
    h3.text-center,
    h4.text-center,
    h5.text-center,
    h6.text-center,
    p.text-center,
    span.text-center {
        text-align: center; }

    h1.text-left,
    h2.text-left,
    h3.text-left,
    h4.text-left,
    h5.text-left,
    h6.text-left,
    p.text-left,
    span.text-left {
        text-align: left; }

    h1.text-right,
    h2.text-right,
    h3.text-right,
    h4.text-right,
    h5.text-right,
    h6.text-right,
    p.text-right,
    span.text-right {
        text-align: right; }

    span.text-center {
        display: block;
        width: 100%;
        text-align: center; }

    img.float-left {
        float: left;
        text-align: left; }

    img.float-right {
        float: right;
        text-align: right; }

    img.float-center,
    img.text-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.float-center,
    td.float-center,
    th.float-center {
        margin: 0 auto;
        Margin: 0 auto;
        float: none;
        text-align: center; }

    table.body table.container .hide-for-large {
        display: none;
        width: 0;
        mso-hide: all;
        overflow: hidden;
        max-height: 0px;
        font-size: 0;
        width: 0px;
        line-height: 0; }

    body,
    table.body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    td,
    th,
    a {
        color: #0a0a0a;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        padding: 0;
        margin: 0;
        Margin: 0;
        text-align: left;
        line-height: 1.3; }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: inherit;
        word-wrap: normal;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: normal;
        margin-bottom: 10px;
        Margin-bottom: 10px; }

    h1 {
        font-size: 34px; }

    h2 {
        font-size: 30px; }

    h3 {
        font-size: 28px; }

    h4 {
        font-size: 24px; }

    h5 {
        font-size: 20px; }

    h6 {
        font-size: 18px; }

    body,
    table.body,
    p,
    td,
    th {
        font-size: 15px;
        line-height: 19px; }

    p {
        margin-bottom: 10px;
        Margin-bottom: 10px; }
    p.lead {
        font-size: 18.75px;
        line-height: 1.6; }
    p.subheader {
        margin-top: 4px;
        margin-bottom: 8px;
        Margin-top: 4px;
        Margin-bottom: 8px;
        font-weight: normal;
        line-height: 1.4;
        color: #8a8a8a; }

    small {
        font-size: 80%;
        color: #cacaca; }

    a {
        color: #f7931d;
        text-decoration: none; }
    a:hover {
        color: #d97908; }
    a:active {
        color: #d97908; }
    a:visited {
        color: #f7931d; }

    h1 a,
    h1 a:visited,
    h2 a,
    h2 a:visited,
    h3 a,
    h3 a:visited,
    h4 a,
    h4 a:visited,
    h5 a,
    h5 a:visited,
    h6 a,
    h6 a:visited {
        color: #f7931d; }

    pre {
        background: #f0f0f0;
        margin: 30px 0;
        Margin: 30px 0; }
    pre code {
        color: #cacaca; }
        pre code span.callout {
            color: #8a8a8a;
            font-weight: bold; }
    pre code span.callout-strong {
        color: #ff6908;
        font-weight: bold; }

    hr {
        max-width: 580px;
        height: 0;
        border-right: 0;
        border-top: 0;
        border-bottom: 1px solid #cacaca;
        border-left: 0;
        margin: 20px auto;
        Margin: 20px auto;
        clear: both; }

    .stat {
        font-size: 40px;
        line-height: 1; }
    p + .stat {
        margin-top: -16px;
        Margin-top: -16px; }

    table.button {
        width: auto !important;
        margin: 0 0 16px 0;
        Margin: 0 0 16px 0; }
    table.button table td {
        width: auto !important;
        text-align: left;
        color: #fefefe;
        background: #f7931d;
        border: 2px solid #f7931d; }
        table.button table td.radius {
            border-radius: 3px; }
    table.button table td.rounded {
        border-radius: 500px; }
        table.button table td a {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #fefefe;
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px 8px 16px;
            border: 0px solid #f7931d;
            border-radius: 3px; }

    table.button:hover table tr td a,
    table.button:active table tr td a,
    table.button table tr td a:visited,
    table.button.tiny:hover table tr td a,
    table.button.tiny:active table tr td a,
    table.button.tiny table tr td a:visited,
    table.button.small:hover table tr td a,
    table.button.small:active table tr td a,
    table.button.small table tr td a:visited,
    table.button.large:hover table tr td a,
    table.button.large:active table tr td a,
    table.button.large table tr td a:visited {
        color: #fefefe; }

    table.button.tiny table td,
    table.button.tiny table a {
        padding: 4px 8px 4px 8px; }

    table.button.tiny table a {
        font-size: 10px;
        font-weight: normal; }

    table.button.small table td,
    table.button.small table a {
        padding: 5px 10px 5px 10px;
        font-size: 12px; }

    table.button.large table a {
        padding: 10px 20px 10px 20px;
        font-size: 20px; }

    table.expand,
    table.expanded {
        width: 100% !important; }
    table.expand table,
    table.expanded table {
        width: 100%; }
        table.expand table a,
        table.expanded table a {
            text-align: center; }
    table.expand center,
    table.expanded center {
        min-width: 0; }

    table.button:hover table td,
    table.button:visited table td,
    table.button:active table td {
        background: #d97908;
        color: #fefefe; }

    table.button:hover table a,
    table.button:visited table a,
    table.button:active table a {
        border: 0px solid #d97908; }

    table.button.secondary table td {
        background: #777777;
        color: #fefefe;
        border: 2px solid #777777; }

    table.button.secondary table a {
        color: #fefefe;
        border: 0px solid #777777; }

    table.button.secondary:hover table td {
        background: #919191;
        color: #fefefe; }

    table.button.secondary:hover table a {
        border: 0px solid #919191; }

    table.button.secondary:hover table td a {
        color: #fefefe; }

    table.button.secondary:active table td a {
        color: #fefefe; }

    table.button.secondary table td a:visited {
        color: #fefefe; }

    table.button.success table td {
        background: #3adb76;
        border: 2px solid #3adb76; }

    table.button.success table a {
        border: 0px solid #3adb76; }

    table.button.success:hover table td {
        background: #23bf5d; }

    table.button.success:hover table a {
        border: 0px solid #23bf5d; }

    table.button.alert table td {
        background: #ec5840;
        border: 2px solid #ec5840; }

    table.button.alert table a {
        border: 0px solid #ec5840; }

    table.button.alert:hover table td {
        background: #e23317; }

    table.button.alert:hover table a {
        border: 0px solid #e23317; }

    table.callout {
        margin-bottom: 16px;
        Margin-bottom: 16px; }

    th.callout-inner {
        width: 100%;
        border: 1px solid #cbcbcb;
        padding: 10px;
        background: #fefefe; }
    th.callout-inner.primary {
        background: #feefdd;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.secondary {
        background: #ebebeb;
        border: 1px solid #444444;
        color: #0a0a0a; }
    th.callout-inner.success {
        background: #e1faea;
        border: 1px solid #1b9448;
        color: #fefefe; }
    th.callout-inner.warning {
        background: #fff3d9;
        border: 1px solid #996800;
        color: #fefefe; }
    th.callout-inner.alert {
        background: #fce6e2;
        border: 1px solid #b42912;
        color: #fefefe; }

    .thumbnail {
        border: solid 4px #fefefe;
        box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
        display: inline-block;
        line-height: 0;
        max-width: 100%;
        transition: box-shadow 200ms ease-out;
        border-radius: 3px;
        margin-bottom: 16px; }
    .thumbnail:hover, .thumbnail:focus {
        box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

    table.menu {
        width: 580px; }
    table.menu td.menu-item,
    table.menu th.menu-item {
        padding: 10px;
        padding-right: 10px; }
        table.menu td.menu-item a,
        table.menu th.menu-item a {
            color: #f7931d; }

    table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item {
        padding: 10px;
        padding-right: 0;
        display: block; }
    table.menu.vertical td.menu-item a,
    table.menu.vertical th.menu-item a {
        width: 100%; }

    table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
    table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
        padding-left: 10px; }

    table.menu.text-center a {
        text-align: center; }

    .menu[align="center"] {
        width: auto !important; }

    body.outlook p {
        display: inline !important; }



    .footer-drip {
        background: #F3F3F3;
        border-radius: 0 0 10px 10px; }

    .footer-drip .columns {
        padding-top: 16px; }

    .container.header-drip {
        background: #F3F3F3; }

    .container.header-drip .columns {
        padding-bottom: 16px;
        padding-top: 16px; }

    .container.body-drip {
        border-radius: 10px;
        border-top: 10px solid #663399; }

    .header {
        background: #8a8a8a; }

    .header p {
        color: #ffffff;
        margin: 0; }

    .header .columns {
        padding-bottom: 0; }

    .header .container {
        background: #8a8a8a;
        padding-top: 16px;
        padding-bottom: 16px; }

    .header .container td {
        padding-top: 16px;
        padding-bottom: 16px; }

    .grey {
        background: #f0f0f0; }

    .border-test {
        border: 1px solid #ccc; }

    .masthead {
        background: #212121; }

    .swu-logo {
        width: 170px;
        height: auto;
        padding: 15px 0px 0px 0px; }

    .masthead h1 {
        color: #f7931d;
        padding: 35px 0px 15px 0px; }

    .column-border {
        border: 1px solid #eee; }

    .footercopy {
        padding: 20px 0px;
        font-size: 12px;
        color: #777777; }

    p {
        color: #777777 !important; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .hide-for-large {
            display: block !important;
            width: auto !important;
            overflow: visible !important; } }

    table.body table.container .hide-for-large * {
        mso-hide: all; }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .row.hide-for-large,
        table.body table.container .row.hide-for-large {
            display: table !important;
            width: 100% !important; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body table.container .show-for-large {
            display: none !important;
            width: 0;
            mso-hide: all;
            overflow: hidden; } }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        table.body img {
            width: auto !important;
            height: auto !important; }
    table.body center {
        min-width: 0 !important; }
    table.body .container {
        width: 95% !important; }
    table.body .columns,
    table.body .column {
        height: auto !important;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding-left: 16px !important;
        padding-right: 16px !important; }
        table.body .columns .column,
        table.body .columns .columns,
        table.body .column .column,
        table.body .column .columns {
            padding-left: 0 !important;
            padding-right: 0 !important; }
    table.body .collapse .columns,
    table.body .collapse .column {
        padding-left: 0 !important;
        padding-right: 0 !important; }
    td.small-1,
    th.small-1 {
        display: inline-block !important;
        width: 8.33333% !important; }
    td.small-2,
    th.small-2 {
        display: inline-block !important;
        width: 16.66667% !important; }
    td.small-3,
    th.small-3 {
        display: inline-block !important;
        width: 25% !important; }
    td.small-4,
    th.small-4 {
        display: inline-block !important;
        width: 33.33333% !important; }
    td.small-5,
    th.small-5 {
        display: inline-block !important;
        width: 41.66667% !important; }
    td.small-6,
    th.small-6 {
        display: inline-block !important;
        width: 50% !important; }
    td.small-7,
    th.small-7 {
        display: inline-block !important;
        width: 58.33333% !important; }
    td.small-8,
    th.small-8 {
        display: inline-block !important;
        width: 66.66667% !important; }
    td.small-9,
    th.small-9 {
        display: inline-block !important;
        width: 75% !important; }
    td.small-10,
    th.small-10 {
        display: inline-block !important;
        width: 83.33333% !important; }
    td.small-11,
    th.small-11 {
        display: inline-block !important;
        width: 91.66667% !important; }
    td.small-12,
    th.small-12 {
        display: inline-block !important;
        width: 100% !important; }
    .columns td.small-12,
    .column td.small-12,
    .columns th.small-12,
    .column th.small-12 {
        display: block !important;
        width: 100% !important; }
    .body .columns td.small-1,
    .body .column td.small-1,
    td.small-1 center,
    .body .columns th.small-1,
    .body .column th.small-1,
    th.small-1 center {
        display: inline-block !important;
        width: 8.33333% !important; }
    .body .columns td.small-2,
    .body .column td.small-2,
    td.small-2 center,
    .body .columns th.small-2,
    .body .column th.small-2,
    th.small-2 center {
        display: inline-block !important;
        width: 16.66667% !important; }
    .body .columns td.small-3,
    .body .column td.small-3,
    td.small-3 center,
    .body .columns th.small-3,
    .body .column th.small-3,
    th.small-3 center {
        display: inline-block !important;
        width: 25% !important; }
    .body .columns td.small-4,
    .body .column td.small-4,
    td.small-4 center,
    .body .columns th.small-4,
    .body .column th.small-4,
    th.small-4 center {
        display: inline-block !important;
        width: 33.33333% !important; }
    .body .columns td.small-5,
    .body .column td.small-5,
    td.small-5 center,
    .body .columns th.small-5,
    .body .column th.small-5,
    th.small-5 center {
        display: inline-block !important;
        width: 41.66667% !important; }
    .body .columns td.small-6,
    .body .column td.small-6,
    td.small-6 center,
    .body .columns th.small-6,
    .body .column th.small-6,
    th.small-6 center {
        display: inline-block !important;
        width: 50% !important; }
    .body .columns td.small-7,
    .body .column td.small-7,
    td.small-7 center,
    .body .columns th.small-7,
    .body .column th.small-7,
    th.small-7 center {
        display: inline-block !important;
        width: 58.33333% !important; }
    .body .columns td.small-8,
    .body .column td.small-8,
    td.small-8 center,
    .body .columns th.small-8,
    .body .column th.small-8,
    th.small-8 center {
        display: inline-block !important;
        width: 66.66667% !important; }
    .body .columns td.small-9,
    .body .column td.small-9,
    td.small-9 center,
    .body .columns th.small-9,
    .body .column th.small-9,
    th.small-9 center {
        display: inline-block !important;
        width: 75% !important; }
    .body .columns td.small-10,
    .body .column td.small-10,
    td.small-10 center,
    .body .columns th.small-10,
    .body .column th.small-10,
    th.small-10 center {
        display: inline-block !important;
        width: 83.33333% !important; }
    .body .columns td.small-11,
    .body .column td.small-11,
    td.small-11 center,
    .body .columns th.small-11,
    .body .column th.small-11,
    th.small-11 center {
        display: inline-block !important;
        width: 91.66667% !important; }
    table.body td.small-offset-1,
    table.body th.small-offset-1 {
        margin-left: 8.33333% !important;
        Margin-left: 8.33333% !important; }
    table.body td.small-offset-2,
    table.body th.small-offset-2 {
        margin-left: 16.66667% !important;
        Margin-left: 16.66667% !important; }
    table.body td.small-offset-3,
    table.body th.small-offset-3 {
        margin-left: 25% !important;
        Margin-left: 25% !important; }
    table.body td.small-offset-4,
    table.body th.small-offset-4 {
        margin-left: 33.33333% !important;
        Margin-left: 33.33333% !important; }
    table.body td.small-offset-5,
    table.body th.small-offset-5 {
        margin-left: 41.66667% !important;
        Margin-left: 41.66667% !important; }
    table.body td.small-offset-6,
    table.body th.small-offset-6 {
        margin-left: 50% !important;
        Margin-left: 50% !important; }
    table.body td.small-offset-7,
    table.body th.small-offset-7 {
        margin-left: 58.33333% !important;
        Margin-left: 58.33333% !important; }
    table.body td.small-offset-8,
    table.body th.small-offset-8 {
        margin-left: 66.66667% !important;
        Margin-left: 66.66667% !important; }
    table.body td.small-offset-9,
    table.body th.small-offset-9 {
        margin-left: 75% !important;
        Margin-left: 75% !important; }
    table.body td.small-offset-10,
    table.body th.small-offset-10 {
        margin-left: 83.33333% !important;
        Margin-left: 83.33333% !important; }
    table.body td.small-offset-11,
    table.body th.small-offset-11 {
        margin-left: 91.66667% !important;
        Margin-left: 91.66667% !important; }
    table.body table.columns td.expander,
    table.body table.columns th.expander {
        display: none !important; }
    table.body .right-text-pad,
    table.body .text-pad-right {
        padding-left: 10px !important; }
    table.body .left-text-pad,
    table.body .text-pad-left {
        padding-right: 10px !important; }
    table.menu {
        width: 100% !important; }
        table.menu td,
        table.menu th {
            width: auto !important;
            display: inline-block !important; }
    table.menu.vertical td,
    table.menu.vertical th, table.menu.small-vertical td,
    table.menu.small-vertical th {
        display: block !important; }
    table.menu[align="center"] {
        width: auto !important; }
    table.button.expand {
        width: 100% !important; }
    }
</style>

<style type="text/css" media="only screen and (max-width: 596px)">
    @media only screen and (max-width: 596px) {
        .small-float-center {
            margin: 0 auto !important;
            float: none !important;
            text-align: center !important; }
        .small-text-center {
            text-align: center !important; }
        .small-text-left {
        text-align: left !important; }
        .small-text-right {
        text-align: right !important; }
    }
</style>

    </head>
    <body>
        <table class="body">
            <tr>
                <td class="center" align="center" valign="top">
                    <center data-parsed="">
                        <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                                        <table class="row grey"><tbody><tr>
                                                    <th class="small-12 large-12 columns first last">
                                                        <table>
                                                            <tr>
                                                                <th>
                                                                    &#xA0; 
                                                                </th>
                                                                <th class="expander"></th>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr></tbody></table>
                                    </td></tr></tbody></table>

                                    <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                                                    <table class="row"><tbody><tr> <!-- Logo -->
                                                                <th class="small-12 large-12 columns first last">
                                                                    <table>
                                                                        <tr>
                                                                            <th>
                                                                                <center data-parsed="">
                                                                                    <a href="http://www.sendwithus.com" align="center" class="text-center">
                                                                                        <img src="https://www.sendwithus.com/assets/img/zurb-template-images/logo-placeholder.png" class="swu-logo">
                                                                                    </a>
                                                                                </center>
                                                                            </th>
                                                                            <th class="expander"></th>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr></tbody></table>
                                                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                                                        <th class="small-12 large-12 columns first last">
                                                                            <table>
                                                                                <tr>
                                                                                    <th>
                                                                                        <h1 class="text-center">Welcome Email!</h1>
                                                                                        <center data-parsed="">
                                                                                            <img src="https://www.sendwithus.com/assets/img/zurb-template-images/cat-placeholder.png" valign="bottom" align="center" class="text-center">
                                                                                        </center>
                                                                                    </th>
                                                                                    <th class="expander"></th>
                                                                                </tr>
                                                                            </table>
                                                                        </th>
                                                                    </tr></tbody></table>
                                                                    <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                                                                <th class="small-12 large-12 columns first last">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <th>
                                                                                                &#xA0; 
                                                                                            </th>
                                                                                            <th class="expander"></th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </th>
                                                                            </tr></tbody></table>
                                                                            <table class="row"><tbody><tr> <!-- main Email content -->
                                                                                        <th class="small-12 large-12 columns first last">
                                                                                            <table>
                                                                                                <tr>
                                                                                                    <th>
                                                                                                        <b><h5>Welcome!</h5></b>
                                                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                                                                        <br>
                                                                                                        <table class="button swu-button"><tr><td><table><tr><td><a href="#">Click le Button</a></td></tr></table></td></tr></table>
                                                                                                    </th>
                                                                                                    <th class="expander"></th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </th>
                                                                                    </tr></tbody></table>
                                                                                    <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                                                                                <th class="small-12 large-12 columns first last">
                                                                                                    <table>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                &#xA0; 
                                                                                                            </th>
                                                                                                            <th class="expander"></th>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </th>
                                                                                            </tr></tbody></table>
                                                </td></tr></tbody></table>  <!-- end main email content --> 

                                                <table class="container text-center"><tbody><tr><td> <!-- footer -->
                                                                <table class="row grey"><tbody><tr>
                                                                            <th class="small-12 large-12 columns first last">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <p class="text-center footercopy">&#xA9; Copyright 2016 Sendwithus. All Rights Reserved.</p>
                                                                                        </th>
                                                                                        <th class="expander"></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr></tbody></table>
                                                            </td></tr></tbody></table>  



                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>'
            ],
            'title 3' => [
                'some description some description some description some description some description some description some description some description some description some description some description',
                'welcome-2.png',
                '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        #outlook a {padding: 0; }
        body {
            width: 100% !important;
            min-width: 100%;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box; }

        .ExternalClass {
            width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%; }

        #backgroundTable {
            margin: 0;
            Margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important; }

        img {
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
            width: auto;
            max-width: 100%;
            clear: both;
            display: block; }

        center {
            width: 100%;
            min-width: 580px; }

        a img {
            border: none; }

        p {
            margin: 0 0 0 10px;
            Margin: 0 0 0 10px; }

        table {
            border-spacing: 0;
            border-collapse: collapse; }

        td {
            word-wrap: break-word;
            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            hyphens: auto;
            border-collapse: collapse !important; }

        table, tr, td {
            padding: 0;
            vertical-align: top;
            text-align: left; }

        html {
            min-height: 100%;
            background: #f0f0f0; }

        table.body {
            background: #f0f0f0;
            height: 100%;
            width: 100%; }

        table.container {
            background: #fefefe;
            width: 580px;
            margin: 0 auto;
            Margin: 0 auto;
            text-align: inherit; }

        table.row {
            padding: 0;
            width: 100%;
            position: relative;
            margin: 0;
        }

        table.container table.row {
            display: table; }

        td.columns,
        td.column,
        th.columns,
        th.column {
            margin: 0 auto;
            Margin: 0 auto;
            padding-left: 16px;
            padding-bottom: 16px; }

        td.columns.last,
        td.column.last,
        th.columns.last,
        th.column.last {
            padding-right: 16px; }

        td.columns table,
        td.column table,
        th.columns table,
        th.column table {
            width: 100%; }

        td.large-1,
        th.large-1 {
            width: 32.33333px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-1.first,
        th.large-1.first {
            padding-left: 16px; }

        td.large-1.last,
        th.large-1.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-1,
        .collapse > tbody > tr > th.large-1 {
            padding-right: 0;
            padding-left: 0;
            width: 48.33333px; }

        .collapse td.large-1.first,
        .collapse th.large-1.first,
        .collapse td.large-1.last,
        .collapse th.large-1.last {
            width: 56.33333px; }

        td.large-2,
        th.large-2 {
            width: 80.66667px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-2.first,
        th.large-2.first {
            padding-left: 16px; }

        td.large-2.last,
        th.large-2.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-2,
        .collapse > tbody > tr > th.large-2 {
            padding-right: 0;
            padding-left: 0;
            width: 96.66667px; }

        .collapse td.large-2.first,
        .collapse th.large-2.first,
        .collapse td.large-2.last,
        .collapse th.large-2.last {
            width: 104.66667px; }

        td.large-3,
        th.large-3 {
            width: 129px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-3.first,
        th.large-3.first {
            padding-left: 16px; }

        td.large-3.last,
        th.large-3.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-3,
        .collapse > tbody > tr > th.large-3 {
            padding-right: 0;
            padding-left: 0;
            width: 145px; }

        .collapse td.large-3.first,
        .collapse th.large-3.first,
        .collapse td.large-3.last,
        .collapse th.large-3.last {
            width: 153px; }

        td.large-4,
        th.large-4 {
            width: 177.33333px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-4.first,
        th.large-4.first {
            padding-left: 16px; }

        td.large-4.last,
        th.large-4.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-4,
        .collapse > tbody > tr > th.large-4 {
            padding-right: 0;
            padding-left: 0;
            width: 193.33333px; }

        .collapse td.large-4.first,
        .collapse th.large-4.first,
        .collapse td.large-4.last,
        .collapse th.large-4.last {
            width: 201.33333px; }

        td.large-5,
        th.large-5 {
            width: 225.66667px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-5.first,
        th.large-5.first {
            padding-left: 16px; }

        td.large-5.last,
        th.large-5.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-5,
        .collapse > tbody > tr > th.large-5 {
            padding-right: 0;
            padding-left: 0;
            width: 241.66667px; }

        .collapse td.large-5.first,
        .collapse th.large-5.first,
        .collapse td.large-5.last,
        .collapse th.large-5.last {
            width: 249.66667px; }

        td.large-6,
        th.large-6 {
            width: 274px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-6.first,
        th.large-6.first {
            padding-left: 16px; }

        td.large-6.last,
        th.large-6.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-6,
        .collapse > tbody > tr > th.large-6 {
            padding-right: 0;
            padding-left: 0;
            width: 290px; }

        .collapse td.large-6.first,
        .collapse th.large-6.first,
        .collapse td.large-6.last,
        .collapse th.large-6.last {
            width: 298px; }

        td.large-7,
        th.large-7 {
            width: 322.33333px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-7.first,
        th.large-7.first {
            padding-left: 16px; }

        td.large-7.last,
        th.large-7.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-7,
        .collapse > tbody > tr > th.large-7 {
            padding-right: 0;
            padding-left: 0;
            width: 338.33333px; }

        .collapse td.large-7.first,
        .collapse th.large-7.first,
        .collapse td.large-7.last,
        .collapse th.large-7.last {
            width: 346.33333px; }

        td.large-8,
        th.large-8 {
            width: 370.66667px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-8.first,
        th.large-8.first {
            padding-left: 16px; }

        td.large-8.last,
        th.large-8.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-8,
        .collapse > tbody > tr > th.large-8 {
            padding-right: 0;
            padding-left: 0;
            width: 386.66667px; }

        .collapse td.large-8.first,
        .collapse th.large-8.first,
        .collapse td.large-8.last,
        .collapse th.large-8.last {
            width: 394.66667px; }

        td.large-9,
        th.large-9 {
            width: 419px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-9.first,
        th.large-9.first {
            padding-left: 16px; }

        td.large-9.last,
        th.large-9.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-9,
        .collapse > tbody > tr > th.large-9 {
            padding-right: 0;
            padding-left: 0;
            width: 435px; }

        .collapse td.large-9.first,
        .collapse th.large-9.first,
        .collapse td.large-9.last,
        .collapse th.large-9.last {
            width: 443px; }

        td.large-10,
        th.large-10 {
            width: 467.33333px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-10.first,
        th.large-10.first {
            padding-left: 16px; }

        td.large-10.last,
        th.large-10.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-10,
        .collapse > tbody > tr > th.large-10 {
            padding-right: 0;
            padding-left: 0;
            width: 483.33333px; }

        .collapse td.large-10.first,
        .collapse th.large-10.first,
        .collapse td.large-10.last,
        .collapse th.large-10.last {
            width: 491.33333px; }

        td.large-11,
        th.large-11 {
            width: 515.66667px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-11.first,
        th.large-11.first {
            padding-left: 16px; }

        td.large-11.last,
        th.large-11.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-11,
        .collapse > tbody > tr > th.large-11 {
            padding-right: 0;
            padding-left: 0;
            width: 531.66667px; }

        .collapse td.large-11.first,
        .collapse th.large-11.first,
        .collapse td.large-11.last,
        .collapse th.large-11.last {
            width: 539.66667px; }

        td.large-12,
        th.large-12 {
            width: 564px;
            padding-left: 8px;
            padding-right: 8px; }

        td.large-12.first,
        th.large-12.first {
            padding-left: 16px; }

        td.large-12.last,
        th.large-12.last {
            padding-right: 16px; }

        .collapse > tbody > tr > td.large-12,
        .collapse > tbody > tr > th.large-12 {
            padding-right: 0;
            padding-left: 0;
            width: 580px; }

        .collapse td.large-12.first,
        .collapse th.large-12.first,
        .collapse td.large-12.last,
        .collapse th.large-12.last {
            width: 588px; }

        td.large-1 center,
        th.large-1 center {
            min-width: 0.33333px; }

        td.large-2 center,
        th.large-2 center {
            min-width: 48.66667px; }

        td.large-3 center,
        th.large-3 center {
            min-width: 97px; }

        td.large-4 center,
        th.large-4 center {
            min-width: 145.33333px; }

        td.large-5 center,
        th.large-5 center {
            min-width: 193.66667px; }

        td.large-6 center,
        th.large-6 center {
            min-width: 242px; }

        td.large-7 center,
        th.large-7 center {
            min-width: 290.33333px; }

        td.large-8 center,
        th.large-8 center {
            min-width: 338.66667px; }

        td.large-9 center,
        th.large-9 center {
            min-width: 387px; }

        td.large-10 center,
        th.large-10 center {
            min-width: 435.33333px; }

        td.large-11 center,
        th.large-11 center {
            min-width: 483.66667px; }

        td.large-12 center,
        th.large-12 center {
            min-width: 532px; }

        .body .columns td.large-1,
        .body .column td.large-1,
        .body .columns th.large-1,
        .body .column th.large-1 {
            width: 8.33333%; }

        .body .columns td.large-2,
        .body .column td.large-2,
        .body .columns th.large-2,
        .body .column th.large-2 {
            width: 16.66667%; }

        .body .columns td.large-3,
        .body .column td.large-3,
        .body .columns th.large-3,
        .body .column th.large-3 {
            width: 25%; }

        .body .columns td.large-4,
        .body .column td.large-4,
        .body .columns th.large-4,
        .body .column th.large-4 {
            width: 33.33333%; }

        .body .columns td.large-5,
        .body .column td.large-5,
        .body .columns th.large-5,
        .body .column th.large-5 {
            width: 41.66667%; }

        .body .columns td.large-6,
        .body .column td.large-6,
        .body .columns th.large-6,
        .body .column th.large-6 {
            width: 50%; }

        .body .columns td.large-7,
        .body .column td.large-7,
        .body .columns th.large-7,
        .body .column th.large-7 {
            width: 58.33333%; }

        .body .columns td.large-8,
        .body .column td.large-8,
        .body .columns th.large-8,
        .body .column th.large-8 {
            width: 66.66667%; }

        .body .columns td.large-9,
        .body .column td.large-9,
        .body .columns th.large-9,
        .body .column th.large-9 {
            width: 75%; }

        .body .columns td.large-10,
        .body .column td.large-10,
        .body .columns th.large-10,
        .body .column th.large-10 {
            width: 83.33333%; }

        .body .columns td.large-11,
        .body .column td.large-11,
        .body .columns th.large-11,
        .body .column th.large-11 {
            width: 91.66667%; }

        .body .columns td.large-12,
        .body .column td.large-12,
        .body .columns th.large-12,
        .body .column th.large-12 {
            width: 100%; }

        td.large-offset-1,
        td.large-offset-1.first,
        td.large-offset-1.last,
        th.large-offset-1,
        th.large-offset-1.first,
        th.large-offset-1.last {
            padding-left: 64.33333px; }

        td.large-offset-2,
        td.large-offset-2.first,
        td.large-offset-2.last,
        th.large-offset-2,
        th.large-offset-2.first,
        th.large-offset-2.last {
            padding-left: 112.66667px; }

        td.large-offset-3,
        td.large-offset-3.first,
        td.large-offset-3.last,
        th.large-offset-3,
        th.large-offset-3.first,
        th.large-offset-3.last {
            padding-left: 161px; }

        td.large-offset-4,
        td.large-offset-4.first,
        td.large-offset-4.last,
        th.large-offset-4,
        th.large-offset-4.first,
        th.large-offset-4.last {
            padding-left: 209.33333px; }

        td.large-offset-5,
        td.large-offset-5.first,
        td.large-offset-5.last,
        th.large-offset-5,
        th.large-offset-5.first,
        th.large-offset-5.last {
            padding-left: 257.66667px; }

        td.large-offset-6,
        td.large-offset-6.first,
        td.large-offset-6.last,
        th.large-offset-6,
        th.large-offset-6.first,
        th.large-offset-6.last {
            padding-left: 306px; }

        td.large-offset-7,
        td.large-offset-7.first,
        td.large-offset-7.last,
        th.large-offset-7,
        th.large-offset-7.first,
        th.large-offset-7.last {
            padding-left: 354.33333px; }

        td.large-offset-8,
        td.large-offset-8.first,
        td.large-offset-8.last,
        th.large-offset-8,
        th.large-offset-8.first,
        th.large-offset-8.last {
            padding-left: 402.66667px; }

        td.large-offset-9,
        td.large-offset-9.first,
        td.large-offset-9.last,
        th.large-offset-9,
        th.large-offset-9.first,
        th.large-offset-9.last {
            padding-left: 451px; }

        td.large-offset-10,
        td.large-offset-10.first,
        td.large-offset-10.last,
        th.large-offset-10,
        th.large-offset-10.first,
        th.large-offset-10.last {
            padding-left: 499.33333px; }

        td.large-offset-11,
        td.large-offset-11.first,
        td.large-offset-11.last,
        th.large-offset-11,
        th.large-offset-11.first,
        th.large-offset-11.last {
            padding-left: 547.66667px; }

        td.expander,
        th.expander {
            visibility: hidden;
            width: 0;
            padding: 0 !important; }

        .block-grid {
            width: 100%;
            max-width: 580px; }
        .block-grid td {
            display: inline-block;
            padding: 8px; }

        .up-2 td {
            width: 274px !important; }

        .up-3 td {
            width: 177px !important; }

        .up-4 td {
            width: 129px !important; }

        .up-5 td {
            width: 100px !important; }

        .up-6 td {
            width: 80px !important; }

        .up-7 td {
            width: 66px !important; }

        .up-8 td {
            width: 56px !important; }

        table.text-center,
        td.text-center,
        h1.text-center,
        h2.text-center,
        h3.text-center,
        h4.text-center,
        h5.text-center,
        h6.text-center,
        p.text-center,
        span.text-center {
            text-align: center; }

        h1.text-left,
        h2.text-left,
        h3.text-left,
        h4.text-left,
        h5.text-left,
        h6.text-left,
        p.text-left,
        span.text-left {
            text-align: left; }

        h1.text-right,
        h2.text-right,
        h3.text-right,
        h4.text-right,
        h5.text-right,
        h6.text-right,
        p.text-right,
        span.text-right {
            text-align: right; }

        span.text-center {
            display: block;
            width: 100%;
            text-align: center; }

        img.float-left {
            float: left;
            text-align: left; }

        img.float-right {
            float: right;
            text-align: right; }

        img.float-center,
        img.text-center {
            margin: 0 auto;
            Margin: 0 auto;
            float: none;
            text-align: center; }

        table.float-center,
        td.float-center,
        th.float-center {
            margin: 0 auto;
            Margin: 0 auto;
            float: none;
            text-align: center; }

        table.body table.container .hide-for-large {
            display: none;
            width: 0;
            mso-hide: all;
            overflow: hidden;
            max-height: 0px;
            font-size: 0;
            width: 0px;
            line-height: 0; }

        body,
        table.body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        td,
        th,
        a {
            color: #0a0a0a;
            font-family: Helvetica, Arial, sans-serif;
            font-weight: normal;
            padding: 0;
            margin: 0;
            Margin: 0;
            text-align: left;
            line-height: 1.3; }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: inherit;
            word-wrap: normal;
            font-family: Helvetica, Arial, sans-serif;
            font-weight: normal;
            margin-bottom: 10px;
            Margin-bottom: 10px; }

        h1 {
            font-size: 34px; }

        h2 {
            font-size: 30px; }

        h3 {
            font-size: 28px; }

        h4 {
            font-size: 24px; }

        h5 {
            font-size: 20px; }

        h6 {
            font-size: 18px; }

        body,
         table.body,
         p,
         td,
        th {
            font-size: 15px;
            line-height: 19px; }

        p {
            margin-bottom: 10px;
            Margin-bottom: 10px; }
        p.lead {
            font-size: 18.75px;
            line-height: 1.6; }
        p.subheader {
            margin-top: 4px;
            margin-bottom: 8px;
            Margin-top: 4px;
            Margin-bottom: 8px;
            font-weight: normal;
            line-height: 1.4;
            color: #8a8a8a; }

        small {
            font-size: 80%;
            color: #cacaca; }

        a {
            color: #ce2027;
            text-decoration: none; }
        a:hover {
            color: #ce2027; }
        a:active {
            color: #ce2027; }
        a:visited {
            color: #ce2027; }

        h1 a,
        h1 a:visited,
        h2 a,
        h2 a:visited,
        h3 a,
        h3 a:visited,
        h4 a,
        h4 a:visited,
        h5 a,
        h5 a:visited,
        h6 a,
        h6 a:visited {
            color: #ce2027; }

        pre {
            background: #f0f0f0;
            margin: 30px 0;
            Margin: 30px 0; }
        pre code {
            color: #cacaca; }
        pre code span.callout {
            color: #8a8a8a;
            font-weight: bold; }
        pre code span.callout-strong {
            color: #ce2027;
            font-weight: bold; }

        hr {
            max-width: 580px;
            height: 0;
            border-right: 0;
            border-top: 0;
            border-bottom: 1px solid #cacaca;
            border-left: 0;
            margin: 20px auto;
            Margin: 20px auto;
            clear: both; }

        .stat {
            font-size: 40px;
            line-height: 1; }
        p + .stat {
            margin-top: -16px;
            Margin-top: -16px; }

        table.button {
            width: auto !important;
            margin: 0 0 16px 0;
            Margin: 0 0 16px 0; }
        table.button table td {
            width: auto !important;
            text-align: left;
            color: #fefefe;
            background: #cf1010;
            border: 2px solid #cf1010; }
        table.button table td.radius {
            border-radius: 3px; }
        table.button table td.rounded {
            border-radius: 500px; }
        table.button table td a {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: #fefefe;
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px 8px 16px;
            border: 0px solid #ce2027;
            border-radius: 3px; }

        table.button:hover table tr td a,
        table.button:active table tr td a,
        table.button table tr td a:visited,
        table.button.tiny:hover table tr td a,
        table.button.tiny:active table tr td a,
        table.button.tiny table tr td a:visited,
        table.button.small:hover table tr td a,
        table.button.small:active table tr td a,
        table.button.small table tr td a:visited,
        table.button.large:hover table tr td a,
        table.button.large:active table tr td a,
        table.button.large table tr td a:visited {
            color: #fefefe; }

        table.button.tiny table td,
        table.button.tiny table a {
            padding: 4px 8px 4px 8px; }

        table.button.tiny table a {
            font-size: 10px;
            font-weight: normal; }

        table.button.small table td,
        table.button.small table a {
            padding: 5px 10px 5px 10px;
            font-size: 12px; }

        table.button.large table a {
            padding: 10px 20px 10px 20px;
            font-size: 20px; }

        table.expand,
        table.expanded {
            width: 100% !important; }
        table.expand table,
        table.expanded table {
            width: 100%; }
        table.expand table a,
        table.expanded table a {
            text-align: center; }
        table.expand center,
        table.expanded center {
            min-width: 0; }

        table.button:hover table td,
        table.button:visited table td,
        table.button:active table td {
            background: #cf1010;
            color: #fefefe; }

        table.button:hover table a,
        table.button:visited table a,
        table.button:active table a {
            border: 0px solid #cf1010; }

        table.button.secondary table td {
            background: #777777;
            color: #fefefe;
            border: 2px solid #777777; }

        table.button.secondary table a {
            color: #fefefe;
            border: 0px solid #777777; }

        table.button.secondary:hover table td {
            background: #919191;
            color: #fefefe; }

        table.button.secondary:hover table a {
            border: 0px solid #919191; }

        table.button.secondary:hover table td a {
            color: #fefefe; }

        table.button.secondary:active table td a {
            color: #fefefe; }

        table.button.secondary table td a:visited {
            color: #fefefe; }

        table.button.success table td {
            background: #3adb76;
            border: 2px solid #3adb76; }

        table.button.success table a {
            border: 0px solid #3adb76; }

        table.button.success:hover table td {
            background: #23bf5d; }

        table.button.success:hover table a {
            border: 0px solid #23bf5d; }

        table.button.alert table td {
            background: #ec5840;
            border: 2px solid #ec5840; }

        table.button.alert table a {
            border: 0px solid #ec5840; }

        table.button.alert:hover table td {
            background: #e23317; }

        table.button.alert:hover table a {
            border: 0px solid #e23317; }

        table.callout {
            margin-bottom: 16px;
            Margin-bottom: 16px; }

        th.callout-inner {
            width: 100%;
            border: 1px solid #cbcbcb;
            padding: 10px;
            background: #fefefe; }
        th.callout-inner.primary {
            background: #feefdd;
            border: 1px solid #444444;
            color: #0a0a0a; }
        th.callout-inner.secondary {
            background: #ebebeb;
            border: 1px solid #444444;
            color: #0a0a0a; }
        th.callout-inner.success {
            background: #e1faea;
            border: 1px solid #1b9448;
            color: #fefefe; }
        th.callout-inner.warning {
            background: #fff3d9;
            border: 1px solid #996800;
            color: #fefefe; }
        th.callout-inner.alert {
            background: #fce6e2;
            border: 1px solid #b42912;
            color: #fefefe; }

        .thumbnail {
            border: solid 4px #fefefe;
            box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
            display: inline-block;
            line-height: 0;
            max-width: 100%;
            transition: box-shadow 200ms ease-out;
            border-radius: 3px;
            margin-bottom: 16px; }
        .thumbnail:hover, .thumbnail:focus {
            box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

        table.menu {
            width: 580px; }
        table.menu td.menu-item,
        table.menu th.menu-item {
            padding: 10px;
            padding-right: 10px; }
        table.menu td.menu-item a,
        table.menu th.menu-item a {
            color: #ce2027; }

        table.menu.vertical td.menu-item,
        table.menu.vertical th.menu-item {
            padding: 10px;
            padding-right: 0;
            display: block; }
        table.menu.vertical td.menu-item a,
        table.menu.vertical th.menu-item a {
            width: 100%; }

        table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
        table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
        table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
        table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
            padding-left: 10px; }

        table.menu.text-center a {
            text-align: center; }

        .menu[align="center"] {
            width: auto !important; }

        body.outlook p {
            display: inline !important; }



        .footer-drip {
            background: #F3F3F3;
            border-radius: 0 0 10px 10px; }

        .footer-drip .columns {
            padding-top: 16px; }

        .container.header-drip {
            background: #F3F3F3; }

         .container.header-drip .columns {
            padding-bottom: 16px;
            padding-top: 16px; }

        .container.body-drip {
            border-radius: 10px;
            border-top: 10px solid #663399; }

        .header {
            background: #8a8a8a; }

        .header p {
            color: #ffffff;
            margin: 0; }

        .header .columns {
            padding-bottom: 0; }

        .header .container {
            background: #8a8a8a;
            padding-top: 16px;
            padding-bottom: 16px; }

        .header .container td {
            padding-top: 16px;
            padding-bottom: 16px; }

        .grey {
            background: #f0f0f0; }

        .border-test {
            border: 1px solid #ccc; }

        .masthead {
            background: #212121;
        }

        .swu-logo {
            max-height: 70px;
            width: auto;
            padding: 15px 0px 0px 0px; }

        .masthead h1 {
            color: #ffffff;
            padding: 35px 0px 15px 0px; }

        .column-border {
            border: 1px solid #eee; }

        .footercopy {
            padding: 20px 0px;
            font-size: 12px;
            color: #777777; }

        p {
            color: #777777 !important; }
    </style>

    <style type="text/css" media="only screen and (max-width: 596px)">
        @media only screen and (max-width: 596px) {
            table.body table.container .hide-for-large {
                display: block !important;
                width: auto !important;
                overflow: visible !important; } }

        table.body table.container .hide-for-large * {
            mso-hide: all; }
    </style>

    <style type="text/css" media="only screen and (max-width: 596px)">
        @media only screen and (max-width: 596px) {
            table.body table.container .row.hide-for-large,
            table.body table.container .row.hide-for-large {
                display: table !important;
                width: 100% !important; } }
    </style>

    <style type="text/css" media="only screen and (max-width: 596px)">
        @media only screen and (max-width: 596px) {
            table.body table.container .show-for-large {
                display: none !important;
                width: 0;
                mso-hide: all;
                overflow: hidden; } }
    </style>

    <style type="text/css" media="only screen and (max-width: 596px)">
        @media only screen and (max-width: 596px) {
            table.body img {
                width: auto !important;
                height: auto !important; }
            table.body center {
                min-width: 0 !important; }
            table.body .container {
                width: 95% !important; }
            table.body .columns,
            table.body .column {
                height: auto !important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 16px !important;
                padding-right: 16px !important; }
            table.body .columns .column,
            table.body .columns .columns,
            table.body .column .column,
            table.body .column .columns {
                padding-left: 0 !important;
                padding-right: 0 !important; }
            table.body .collapse .columns,
            table.body .collapse .column {
                padding-left: 0 !important;
                padding-right: 0 !important; }
            td.small-1,
            th.small-1 {
                display: inline-block !important;
                width: 8.33333% !important; }
            td.small-2,
            th.small-2 {
                display: inline-block !important;
                width: 16.66667% !important; }
            td.small-3,
            th.small-3 {
                display: inline-block !important;
                width: 25% !important; }
            td.small-4,
            th.small-4 {
                display: inline-block !important;
                width: 33.33333% !important; }
            td.small-5,
            th.small-5 {
                display: inline-block !important;
                width: 41.66667% !important; }
            td.small-6,
            th.small-6 {
                display: inline-block !important;
                width: 50% !important; }
            td.small-7,
            th.small-7 {
                display: inline-block !important;
                width: 58.33333% !important; }
            td.small-8,
            th.small-8 {
                display: inline-block !important;
                width: 66.66667% !important; }
            td.small-9,
            th.small-9 {
                display: inline-block !important;
                width: 75% !important; }
            td.small-10,
            th.small-10 {
                display: inline-block !important;
                width: 83.33333% !important; }
            td.small-11,
            th.small-11 {
                display: inline-block !important;
                width: 91.66667% !important; }
            td.small-12,
            th.small-12 {
                display: inline-block !important;
                width: 100% !important; }
            .columns td.small-12,
            .column td.small-12,
            .columns th.small-12,
            .column th.small-12 {
                display: block !important;
                width: 100% !important; }
            .body .columns td.small-1,
            .body .column td.small-1,
            td.small-1 center,
            .body .columns th.small-1,
            .body .column th.small-1,
            th.small-1 center {
                display: inline-block !important;
                width: 8.33333% !important; }
            .body .columns td.small-2,
            .body .column td.small-2,
            td.small-2 center,
            .body .columns th.small-2,
            .body .column th.small-2,
            th.small-2 center {
                display: inline-block !important;
                width: 16.66667% !important; }
            .body .columns td.small-3,
            .body .column td.small-3,
            td.small-3 center,
            .body .columns th.small-3,
            .body .column th.small-3,
            th.small-3 center {
                display: inline-block !important;
                width: 25% !important; }
            .body .columns td.small-4,
            .body .column td.small-4,
            td.small-4 center,
            .body .columns th.small-4,
            .body .column th.small-4,
            th.small-4 center {
                display: inline-block !important;
                width: 33.33333% !important; }
            .body .columns td.small-5,
            .body .column td.small-5,
            td.small-5 center,
            .body .columns th.small-5,
            .body .column th.small-5,
            th.small-5 center {
                display: inline-block !important;
                width: 41.66667% !important; }
            .body .columns td.small-6,
            .body .column td.small-6,
            td.small-6 center,
            .body .columns th.small-6,
            .body .column th.small-6,
            th.small-6 center {
                display: inline-block !important;
                width: 50% !important; }
            .body .columns td.small-7,
            .body .column td.small-7,
            td.small-7 center,
            .body .columns th.small-7,
            .body .column th.small-7,
            th.small-7 center {
                display: inline-block !important;
                width: 58.33333% !important; }
            .body .columns td.small-8,
            .body .column td.small-8,
            td.small-8 center,
            .body .columns th.small-8,
            .body .column th.small-8,
            th.small-8 center {
                display: inline-block !important;
                width: 66.66667% !important; }
            .body .columns td.small-9,
            .body .column td.small-9,
            td.small-9 center,
            .body .columns th.small-9,
            .body .column th.small-9,
            th.small-9 center {
                display: inline-block !important;
                width: 75% !important; }
            .body .columns td.small-10,
            .body .column td.small-10,
            td.small-10 center,
            .body .columns th.small-10,
            .body .column th.small-10,
            th.small-10 center {
                display: inline-block !important;
                width: 83.33333% !important; }
            .body .columns td.small-11,
            .body .column td.small-11,
            td.small-11 center,
            .body .columns th.small-11,
            .body .column th.small-11,
            th.small-11 center {
                display: inline-block !important;
                width: 91.66667% !important; }
            table.body td.small-offset-1,
            table.body th.small-offset-1 {
                margin-left: 8.33333% !important;
                Margin-left: 8.33333% !important; }
            table.body td.small-offset-2,
            table.body th.small-offset-2 {
                margin-left: 16.66667% !important;
                Margin-left: 16.66667% !important; }
            table.body td.small-offset-3,
            table.body th.small-offset-3 {
                margin-left: 25% !important;
                Margin-left: 25% !important; }
            table.body td.small-offset-4,
            table.body th.small-offset-4 {
                margin-left: 33.33333% !important;
                Margin-left: 33.33333% !important; }
            table.body td.small-offset-5,
            table.body th.small-offset-5 {
                margin-left: 41.66667% !important;
                Margin-left: 41.66667% !important; }
            table.body td.small-offset-6,
            table.body th.small-offset-6 {
                margin-left: 50% !important;
                Margin-left: 50% !important; }
            table.body td.small-offset-7,
            table.body th.small-offset-7 {
                margin-left: 58.33333% !important;
                Margin-left: 58.33333% !important; }
            table.body td.small-offset-8,
            table.body th.small-offset-8 {
                margin-left: 66.66667% !important;
                Margin-left: 66.66667% !important; }
            table.body td.small-offset-9,
            table.body th.small-offset-9 {
                margin-left: 75% !important;
                Margin-left: 75% !important; }
            table.body td.small-offset-10,
            table.body th.small-offset-10 {
                margin-left: 83.33333% !important;
                Margin-left: 83.33333% !important; }
            table.body td.small-offset-11,
            table.body th.small-offset-11 {
                margin-left: 91.66667% !important;
                Margin-left: 91.66667% !important; }
            table.body table.columns td.expander,
            table.body table.columns th.expander {
                display: none !important; }
            table.body .right-text-pad,
            table.body .text-pad-right {
                padding-left: 10px !important; }
            table.body .left-text-pad,
            table.body .text-pad-left {
                padding-right: 10px !important; }
            table.menu {
                width: 100% !important; }
            table.menu td,
            table.menu th {
                width: auto !important;
                display: inline-block !important; }
            table.menu.vertical td,
            table.menu.vertical th, table.menu.small-vertical td,
            table.menu.small-vertical th {
                display: block !important; }
            table.menu[align="center"] {
                width: auto !important; }
            table.button.expand {
                width: 100% !important; }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 596px)">
        @media only screen and (max-width: 596px) {
            .small-float-center {
                margin: 0 auto !important;
                float: none !important;
                text-align: center !important; }
            .small-text-center {
                text-align: center !important; }
            .small-text-left {
                text-align: left !important; }
            .small-text-right {
                text-align: right !important; }
        }
    </style>

    <style>
        .features tr td{
            padding: 5px 0;;
        }
    </style>

</head>
<body>
<table class="body">
    <tr>
        <td class="center" align="center" valign="top">
            <center data-parsed="">
                <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                            <table class="row grey"><tbody><tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>

                <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                            <table class="row"><tbody><tr> <!-- Logo -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <center data-parsed="">
                                                        <a  align="center" class="text-center">
                                                            <img id="email-logo-html" src="http://ace.huntplex.com/ace/images/ace-logo-black.png" class="swu-logo">
                                                        </a>
                                                    </center>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h1 id="email-heading-html" class="text-center">/%%/HEADING/%%/</h1>
                                                    <center data-parsed="">
                                                        <img src="http://ace.huntplex.com/ace/images/slider2.jpg" valign="bottom" align="center" class="text-center">
                                                    </center>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!-- main Email content -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <b><h5>Hi!</h5></b>
                                                    <p id="email-content-html">/%%/CONTENT/%%/</p>
                                                    <br>

                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                            <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    &#xA0;
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>  <!-- end main email content -->

                <table class="container text-center"><tbody><tr><td> <!-- footer -->
                            <table class="row grey"><tbody><tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p class="text-center footercopy">&#xA9; Copyright /%%/COPYRIGHT/%%/. All Rights Reserved.</p>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr></tbody></table>
                        </td></tr></tbody></table>



            </center>
        </td>
    </tr>
</table>
</body>
</html>',
                '    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        <style type="text/css">
            #outlook a {padding: 0; }
            #email-template-html body {
                width: 100% !important;
                min-width: 100%;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                margin: 0;
                padding: 0;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box; }

            .ExternalClass {
                width: 100%; }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%; }

            #backgroundTable {
                margin: 0;
                Margin: 0;
                padding: 0;
                width: 100% !important;
                line-height: 100% !important; }

            img {
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
                width: auto;
                max-width: 100%;
                clear: both;
                display: block; }

            #email-template-html center {
                width: 100%;
                min-width: 580px; }

             a img {
                border: none; }

            #email-template-html p {
                margin: 0 0 0 10px;
                Margin: 0 0 0 10px; }

            #email-template-html table {
                border-spacing: 0;
                border-collapse: collapse; }

            #email-template-html td {
                word-wrap: break-word;
                -webkit-hyphens: auto;
                -moz-hyphens: auto;
                hyphens: auto;
                border-collapse: collapse !important; }

            #email-template-html table, tr, td {
                padding: 0;
                vertical-align: top;
                text-align: left; }

            #email-template-html html {
                min-height: 100%;
                background: #f0f0f0; }

            #email-template-html table.body {
                background: #f0f0f0;
                height: 100%;
                width: 100%; }

            table.container {
                background: #fefefe;
                width: 580px;
                margin: 0 auto;
                Margin: 0 auto;
                text-align: inherit; }

            #email-template-html table.row {
                padding: 0;
                width: 100%;
                position: relative;
                margin: 0;
            }

            #email-template-html table.container table.row {
                display: table; }

            #email-template-html td.columns,
            #email-template-html td.column,
            #email-template-html th.columns,
            #email-template-html th.column {
                margin: 0 auto;
                Margin: 0 auto;
                padding-left: 16px;
                padding-bottom: 16px; }

            #email-template-html td.columns.last,
            #email-template-html td.column.last,
            #email-template-html th.columns.last,
            #email-template-html th.column.last {
                padding-right: 16px; }

            td.columns table,
            td.column table,
            th.columns table,
            th.column table {
                width: 100%; }

            td.large-1,
            th.large-1 {
                width: 32.33333px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-1.first,
            th.large-1.first {
                padding-left: 16px; }

            td.large-1.last,
            th.large-1.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-1,
            .collapse > tbody > tr > th.large-1 {
                padding-right: 0;
                padding-left: 0;
                width: 48.33333px; }

            .collapse td.large-1.first,
            .collapse th.large-1.first,
            .collapse td.large-1.last,
            .collapse th.large-1.last {
                width: 56.33333px; }

            td.large-2,
            th.large-2 {
                width: 80.66667px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-2.first,
            th.large-2.first {
                padding-left: 16px; }

            td.large-2.last,
            th.large-2.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-2,
            .collapse > tbody > tr > th.large-2 {
                padding-right: 0;
                padding-left: 0;
                width: 96.66667px; }

            .collapse td.large-2.first,
            .collapse th.large-2.first,
            .collapse td.large-2.last,
            .collapse th.large-2.last {
                width: 104.66667px; }

            td.large-3,
            th.large-3 {
                width: 129px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-3.first,
            th.large-3.first {
                padding-left: 16px; }

            td.large-3.last,
            th.large-3.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-3,
            .collapse > tbody > tr > th.large-3 {
                padding-right: 0;
                padding-left: 0;
                width: 145px; }

            .collapse td.large-3.first,
            .collapse th.large-3.first,
            .collapse td.large-3.last,
            .collapse th.large-3.last {
                width: 153px; }

            td.large-4,
            th.large-4 {
                width: 177.33333px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-4.first,
            th.large-4.first {
                padding-left: 16px; }

            td.large-4.last,
            th.large-4.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-4,
            .collapse > tbody > tr > th.large-4 {
                padding-right: 0;
                padding-left: 0;
                width: 193.33333px; }

            .collapse td.large-4.first,
            .collapse th.large-4.first,
            .collapse td.large-4.last,
            .collapse th.large-4.last {
                width: 201.33333px; }

            td.large-5,
            th.large-5 {
                width: 225.66667px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-5.first,
            th.large-5.first {
                padding-left: 16px; }

            td.large-5.last,
            th.large-5.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-5,
            .collapse > tbody > tr > th.large-5 {
                padding-right: 0;
                padding-left: 0;
                width: 241.66667px; }

            .collapse td.large-5.first,
            .collapse th.large-5.first,
            .collapse td.large-5.last,
            .collapse th.large-5.last {
                width: 249.66667px; }

            td.large-6,
            th.large-6 {
                width: 274px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-6.first,
            th.large-6.first {
                padding-left: 16px; }

            td.large-6.last,
            th.large-6.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-6,
            .collapse > tbody > tr > th.large-6 {
                padding-right: 0;
                padding-left: 0;
                width: 290px; }

            .collapse td.large-6.first,
            .collapse th.large-6.first,
            .collapse td.large-6.last,
            .collapse th.large-6.last {
                width: 298px; }

            td.large-7,
            th.large-7 {
                width: 322.33333px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-7.first,
            th.large-7.first {
                padding-left: 16px; }

            td.large-7.last,
            th.large-7.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-7,
            .collapse > tbody > tr > th.large-7 {
                padding-right: 0;
                padding-left: 0;
                width: 338.33333px; }

            .collapse td.large-7.first,
            .collapse th.large-7.first,
            .collapse td.large-7.last,
            .collapse th.large-7.last {
                width: 346.33333px; }

            td.large-8,
            th.large-8 {
                width: 370.66667px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-8.first,
            th.large-8.first {
                padding-left: 16px; }

            td.large-8.last,
            th.large-8.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-8,
            .collapse > tbody > tr > th.large-8 {
                padding-right: 0;
                padding-left: 0;
                width: 386.66667px; }

            .collapse td.large-8.first,
            .collapse th.large-8.first,
            .collapse td.large-8.last,
            .collapse th.large-8.last {
                width: 394.66667px; }

            td.large-9,
            th.large-9 {
                width: 419px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-9.first,
            th.large-9.first {
                padding-left: 16px; }

            td.large-9.last,
            th.large-9.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-9,
            .collapse > tbody > tr > th.large-9 {
                padding-right: 0;
                padding-left: 0;
                width: 435px; }

            .collapse td.large-9.first,
            .collapse th.large-9.first,
            .collapse td.large-9.last,
            .collapse th.large-9.last {
                width: 443px; }

            td.large-10,
            th.large-10 {
                width: 467.33333px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-10.first,
            th.large-10.first {
                padding-left: 16px; }

            td.large-10.last,
            th.large-10.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-10,
            .collapse > tbody > tr > th.large-10 {
                padding-right: 0;
                padding-left: 0;
                width: 483.33333px; }

            .collapse td.large-10.first,
            .collapse th.large-10.first,
            .collapse td.large-10.last,
            .collapse th.large-10.last {
                width: 491.33333px; }

            td.large-11,
            th.large-11 {
                width: 515.66667px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-11.first,
            th.large-11.first {
                padding-left: 16px; }

            td.large-11.last,
            th.large-11.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-11,
            .collapse > tbody > tr > th.large-11 {
                padding-right: 0;
                padding-left: 0;
                width: 531.66667px; }

            .collapse td.large-11.first,
            .collapse th.large-11.first,
            .collapse td.large-11.last,
            .collapse th.large-11.last {
                width: 539.66667px; }

            td.large-12,
            th.large-12 {
                width: 564px;
                padding-left: 8px;
                padding-right: 8px; }

            td.large-12.first,
            th.large-12.first {
                padding-left: 16px; }

            td.large-12.last,
            th.large-12.last {
                padding-right: 16px; }

            .collapse > tbody > tr > td.large-12,
            .collapse > tbody > tr > th.large-12 {
                padding-right: 0;
                padding-left: 0;
                width: 580px; }

            .collapse td.large-12.first,
            .collapse th.large-12.first,
            .collapse td.large-12.last,
            .collapse th.large-12.last {
                width: 588px; }

            td.large-1 center,
            th.large-1 center {
                min-width: 0.33333px; }

            td.large-2 center,
            th.large-2 center {
                min-width: 48.66667px; }

            td.large-3 center,
            th.large-3 center {
                min-width: 97px; }

            td.large-4 center,
            th.large-4 center {
                min-width: 145.33333px; }

            td.large-5 center,
            th.large-5 center {
                min-width: 193.66667px; }

            td.large-6 center,
            th.large-6 center {
                min-width: 242px; }

            td.large-7 center,
            th.large-7 center {
                min-width: 290.33333px; }

            td.large-8 center,
            th.large-8 center {
                min-width: 338.66667px; }

            td.large-9 center,
            th.large-9 center {
                min-width: 387px; }

            td.large-10 center,
            th.large-10 center {
                min-width: 435.33333px; }

            td.large-11 center,
            th.large-11 center {
                min-width: 483.66667px; }

            td.large-12 center,
            th.large-12 center {
                min-width: 532px; }

            .body .columns td.large-1,
            .body .column td.large-1,
            .body .columns th.large-1,
            .body .column th.large-1 {
                width: 8.33333%; }

            .body .columns td.large-2,
            .body .column td.large-2,
            .body .columns th.large-2,
            .body .column th.large-2 {
                width: 16.66667%; }

            .body .columns td.large-3,
            .body .column td.large-3,
            .body .columns th.large-3,
            .body .column th.large-3 {
                width: 25%; }

            .body .columns td.large-4,
            .body .column td.large-4,
            .body .columns th.large-4,
            .body .column th.large-4 {
                width: 33.33333%; }

            .body .columns td.large-5,
            .body .column td.large-5,
            .body .columns th.large-5,
            .body .column th.large-5 {
                width: 41.66667%; }

            .body .columns td.large-6,
            .body .column td.large-6,
            .body .columns th.large-6,
            .body .column th.large-6 {
                width: 50%; }

            .body .columns td.large-7,
            .body .column td.large-7,
            .body .columns th.large-7,
            .body .column th.large-7 {
                width: 58.33333%; }

            .body .columns td.large-8,
            .body .column td.large-8,
            .body .columns th.large-8,
            .body .column th.large-8 {
                width: 66.66667%; }

            .body .columns td.large-9,
            .body .column td.large-9,
            .body .columns th.large-9,
            .body .column th.large-9 {
                width: 75%; }

            .body .columns td.large-10,
            .body .column td.large-10,
            .body .columns th.large-10,
            .body .column th.large-10 {
                width: 83.33333%; }

            .body .columns td.large-11,
            .body .column td.large-11,
            .body .columns th.large-11,
            .body .column th.large-11 {
                width: 91.66667%; }

            .body .columns td.large-12,
            .body .column td.large-12,
            .body .columns th.large-12,
            .body .column th.large-12 {
                width: 100%; }

            td.large-offset-1,
            td.large-offset-1.first,
            td.large-offset-1.last,
            th.large-offset-1,
            th.large-offset-1.first,
            th.large-offset-1.last {
                padding-left: 64.33333px; }

            td.large-offset-2,
            td.large-offset-2.first,
            td.large-offset-2.last,
            th.large-offset-2,
            th.large-offset-2.first,
            th.large-offset-2.last {
                padding-left: 112.66667px; }

            td.large-offset-3,
            td.large-offset-3.first,
            td.large-offset-3.last,
            th.large-offset-3,
            th.large-offset-3.first,
            th.large-offset-3.last {
                padding-left: 161px; }

            td.large-offset-4,
            td.large-offset-4.first,
            td.large-offset-4.last,
            th.large-offset-4,
            th.large-offset-4.first,
            th.large-offset-4.last {
                padding-left: 209.33333px; }

            td.large-offset-5,
            td.large-offset-5.first,
            td.large-offset-5.last,
            th.large-offset-5,
            th.large-offset-5.first,
            th.large-offset-5.last {
                padding-left: 257.66667px; }

            td.large-offset-6,
            td.large-offset-6.first,
            td.large-offset-6.last,
            th.large-offset-6,
            th.large-offset-6.first,
            th.large-offset-6.last {
                padding-left: 306px; }

            td.large-offset-7,
            td.large-offset-7.first,
            td.large-offset-7.last,
            th.large-offset-7,
            th.large-offset-7.first,
            th.large-offset-7.last {
                padding-left: 354.33333px; }

            td.large-offset-8,
            td.large-offset-8.first,
            td.large-offset-8.last,
            th.large-offset-8,
            th.large-offset-8.first,
            th.large-offset-8.last {
                padding-left: 402.66667px; }

            td.large-offset-9,
            td.large-offset-9.first,
            td.large-offset-9.last,
            th.large-offset-9,
            th.large-offset-9.first,
            th.large-offset-9.last {
                padding-left: 451px; }

            td.large-offset-10,
            td.large-offset-10.first,
            td.large-offset-10.last,
            th.large-offset-10,
            th.large-offset-10.first,
            th.large-offset-10.last {
                padding-left: 499.33333px; }

            td.large-offset-11,
            td.large-offset-11.first,
            td.large-offset-11.last,
            th.large-offset-11,
            th.large-offset-11.first,
            th.large-offset-11.last {
                padding-left: 547.66667px; }

            td.expander,
            th.expander {
                visibility: hidden;
                width: 0;
                padding: 0 !important; }

            .block-grid {
                width: 100%;
                max-width: 580px; }
            .block-grid td {
                display: inline-block;
                padding: 8px; }

            .up-2 td {
                width: 274px !important; }

            .up-3 td {
                width: 177px !important; }

            .up-4 td {
                width: 129px !important; }

            .up-5 td {
                width: 100px !important; }

            .up-6 td {
                width: 80px !important; }

            .up-7 td {
                width: 66px !important; }

            .up-8 td {
                width: 56px !important; }

           #email-template-html table.text-center,
           #email-template-html td.text-center,
           #email-template-html h1.text-center,
           #email-template-html h2.text-center,
           #email-template-html h3.text-center,
           #email-template-html h4.text-center,
           #email-template-html h5.text-center,
           #email-template-html h6.text-center,
           #email-template-html p.text-center,
           #email-template-html span.text-center {
                text-align: center; }

            h1.text-left,
            h2.text-left,
            h3.text-left,
            h4.text-left,
            h5.text-left,
            h6.text-left,
            p.text-left,
            span.text-left {
                text-align: left; }

            h1.text-right,
            h2.text-right,
            h3.text-right,
            h4.text-right,
            h5.text-right,
            h6.text-right,
            p.text-right,
            span.text-right {
                text-align: right; }

            span.text-center {
                display: block;
                width: 100%;
                text-align: center; }

            img.float-left {
                float: left;
                text-align: left; }

            img.float-right {
                float: right;
                text-align: right; }

            img.float-center,
            img.text-center {
                margin: 0 auto;
                Margin: 0 auto;
                float: none;
                text-align: center; }

            table.float-center,
            td.float-center,
            th.float-center {
                margin: 0 auto;
                Margin: 0 auto;
                float: none;
                text-align: center; }

            table.body table.container .hide-for-large {
                display: none;
                width: 0;
                mso-hide: all;
                overflow: hidden;
                max-height: 0px;
                font-size: 0;
                width: 0px;
                line-height: 0; }

            #email-template-html body,
            #email-template-html table.body,
            #email-template-html h1,
            #email-template-html h2,
            #email-template-html h3,
            #email-template-html h4,
            #email-template-html h5,
            #email-template-html h6,
            #email-template-html p,
            #email-template-html td,
            #email-template-html th,
            #email-template-html a {
                color: #0a0a0a;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: normal;
                padding: 0;
                margin: 0;
                Margin: 0;
                text-align: left;
                line-height: 1.3; }

            #email-template-html h1,
            #email-template-html h2,
            #email-template-html h3,
            #email-template-html h4,
            #email-template-html h5,
            #email-template-html h6 {
                color: inherit;
                word-wrap: normal;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: normal;
                margin-bottom: 10px;
                Margin-bottom: 10px; }

            #email-template-html h1 {
                font-size: 34px; }

            #email-template-html h2 {
                font-size: 30px; }

            #email-template-html h3 {
                font-size: 28px; }

            #email-template-html h4 {
                font-size: 24px; }

            #email-template-html h5 {
                font-size: 20px; }

            #email-template-html h6 {
                font-size: 18px; }

            #email-template-html body,
            #email-template-html  table.body,
            #email-template-html  p,
            #email-template-html  td,
            #email-template-html th {
                font-size: 15px;
                line-height: 19px; }

            #email-template-html p {
                margin-bottom: 10px;
                Margin-bottom: 10px; }
            #email-template-html p.lead {
                font-size: 18.75px;
                line-height: 1.6; }
            #email-template-html p.subheader {
                margin-top: 4px;
                margin-bottom: 8px;
                Margin-top: 4px;
                Margin-bottom: 8px;
                font-weight: normal;
                line-height: 1.4;
                color: #8a8a8a; }

            #email-template-html small {
                font-size: 80%;
                color: #cacaca; }

            #email-template-html a {
                color: #ce2027;
                text-decoration: none; }
            #email-template-html a:hover {
                color: #ce2027; }
            #email-template-html a:active {
                color: #ce2027; }
            #email-template-html a:visited {
                color: #ce2027; }

            #email-template-html h1 a,
            #email-template-html h1 a:visited,
            #email-template-html h2 a,
            #email-template-html h2 a:visited,
            #email-template-html h3 a,
            #email-template-html h3 a:visited,
            #email-template-html h4 a,
            #email-template-html h4 a:visited,
            #email-template-html h5 a,
            #email-template-html h5 a:visited,
            #email-template-html h6 a,
            #email-template-html h6 a:visited {
                color: #ce2027; }

            pre {
                background: #f0f0f0;
                margin: 30px 0;
                Margin: 30px 0; }
            pre code {
                color: #cacaca; }
            pre code span.callout {
                color: #8a8a8a;
                font-weight: bold; }
            pre code span.callout-strong {
                color: #ce2027;
                font-weight: bold; }

            #email-template-html hr {
                max-width: 580px;
                height: 0;
                border-right: 0;
                border-top: 0;
                border-bottom: 1px solid #cacaca;
                border-left: 0;
                margin: 20px auto;
                Margin: 20px auto;
                clear: both; }

            .stat {
                font-size: 40px;
                line-height: 1; }
            #email-template-html p + .stat {
                margin-top: -16px;
                Margin-top: -16px; }

            #email-template-html table.button {
                width: auto !important;
                margin: 0 0 16px 0;
                Margin: 0 0 16px 0; }
            #email-template-html table.button table td {
                width: auto !important;
                text-align: left;
                color: #fefefe;
                background: #cf1010;
                border: 2px solid #cf1010; }
            #email-template-html table.button table td.radius {
                border-radius: 3px; }
            #email-template-html table.button table td.rounded {
                border-radius: 500px; }
            #email-template-html table.button table td a {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 16px;
                font-weight: bold;
                color: #fefefe;
                text-decoration: none;
                display: inline-block;
                padding: 8px 16px 8px 16px;
                border: 0px solid #ce2027;
                border-radius: 3px; }

            #email-template-html table.button:hover table tr td a,
            #email-template-html table.button:active table tr td a,
            #email-template-html table.button table tr td a:visited,
            #email-template-html table.button.tiny:hover table tr td a,
            #email-template-html table.button.tiny:active table tr td a,
            #email-template-html table.button.tiny table tr td a:visited,
            #email-template-html table.button.small:hover table tr td a,
            #email-template-html table.button.small:active table tr td a,
            #email-template-html table.button.small table tr td a:visited,
            #email-template-html table.button.large:hover table tr td a,
            #email-template-html table.button.large:active table tr td a,
            #email-template-html table.button.large table tr td a:visited {
                color: #fefefe; }

            #email-template-html table.button.tiny table td,
            #email-template-html table.button.tiny table a {
                padding: 4px 8px 4px 8px; }

            #email-template-html table.button.tiny table a {
                font-size: 10px;
                font-weight: normal; }

            #email-template-html table.button.small table td,
            #email-template-html table.button.small table a {
                padding: 5px 10px 5px 10px;
                font-size: 12px; }

            #email-template-html table.button.large table a {
                padding: 10px 20px 10px 20px;
                font-size: 20px; }

            #email-template-html table.expand,
            #email-template-html table.expanded {
                width: 100% !important; }
            #email-template-html table.expand table,
            #email-template-html table.expanded table {
                width: 100%; }
            #email-template-html table.expand table a,
            #email-template-html table.expanded table a {
                text-align: center; }
            table.expand center,
            table.expanded center {
                min-width: 0; }

            table.button:hover table td,
            table.button:visited table td,
            table.button:active table td {
                background: #cf1010;
                color: #fefefe; }

            table.button:hover table a,
            table.button:visited table a,
            table.button:active table a {
                border: 0px solid #cf1010; }

            table.button.secondary table td {
                background: #777777;
                color: #fefefe;
                border: 2px solid #777777; }

            table.button.secondary table a {
                color: #fefefe;
                border: 0px solid #777777; }

            table.button.secondary:hover table td {
                background: #919191;
                color: #fefefe; }

            table.button.secondary:hover table a {
                border: 0px solid #919191; }

            table.button.secondary:hover table td a {
                color: #fefefe; }

            table.button.secondary:active table td a {
                color: #fefefe; }

            table.button.secondary table td a:visited {
                color: #fefefe; }

            table.button.success table td {
                background: #3adb76;
                border: 2px solid #3adb76; }

            table.button.success table a {
                border: 0px solid #3adb76; }

            table.button.success:hover table td {
                background: #23bf5d; }

            table.button.success:hover table a {
                border: 0px solid #23bf5d; }

            table.button.alert table td {
                background: #ec5840;
                border: 2px solid #ec5840; }

            table.button.alert table a {
                border: 0px solid #ec5840; }

            table.button.alert:hover table td {
                background: #e23317; }

            table.button.alert:hover table a {
                border: 0px solid #e23317; }

            table.callout {
                margin-bottom: 16px;
                Margin-bottom: 16px; }

            th.callout-inner {
                width: 100%;
                border: 1px solid #cbcbcb;
                padding: 10px;
                background: #fefefe; }
            th.callout-inner.primary {
                background: #feefdd;
                border: 1px solid #444444;
                color: #0a0a0a; }
            th.callout-inner.secondary {
                background: #ebebeb;
                border: 1px solid #444444;
                color: #0a0a0a; }
            th.callout-inner.success {
                background: #e1faea;
                border: 1px solid #1b9448;
                color: #fefefe; }
            th.callout-inner.warning {
                background: #fff3d9;
                border: 1px solid #996800;
                color: #fefefe; }
            th.callout-inner.alert {
                background: #fce6e2;
                border: 1px solid #b42912;
                color: #fefefe; }

            .thumbnail {
                border: solid 4px #fefefe;
                box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.2);
                display: inline-block;
                line-height: 0;
                max-width: 100%;
                transition: box-shadow 200ms ease-out;
                border-radius: 3px;
                margin-bottom: 16px; }
            .thumbnail:hover, .thumbnail:focus {
                box-shadow: 0 0 6px 1px rgba(247, 147, 29, 0.5); }

            table.menu {
                width: 580px; }
            table.menu td.menu-item,
            table.menu th.menu-item {
                padding: 10px;
                padding-right: 10px; }
            table.menu td.menu-item a,
            table.menu th.menu-item a {
                color: #ce2027; }

            table.menu.vertical td.menu-item,
            table.menu.vertical th.menu-item {
                padding: 10px;
                padding-right: 0;
                display: block; }
            table.menu.vertical td.menu-item a,
            table.menu.vertical th.menu-item a {
                width: 100%; }

            table.menu.vertical td.menu-item table.menu.vertical td.menu-item,
            table.menu.vertical td.menu-item table.menu.vertical th.menu-item,
            table.menu.vertical th.menu-item table.menu.vertical td.menu-item,
            table.menu.vertical th.menu-item table.menu.vertical th.menu-item {
                padding-left: 10px; }

            table.menu.text-center a {
                text-align: center; }

            #email-template-html .menu[align="center"] {
                width: auto !important; }

            #email-template-html body.outlook p {
                display: inline !important; }



            #email-template-html .footer-drip {
                background: #F3F3F3;
                border-radius: 0 0 10px 10px; }

            .footer-drip .columns {
                padding-top: 16px; }

            .container.header-drip {
                background: #F3F3F3; }

            #email-template-html  .container.header-drip .columns {
                padding-bottom: 16px;
                padding-top: 16px; }

            #email-template-html .container.body-drip {
                border-radius: 10px;
                border-top: 10px solid #663399; }

            #email-template-html .header {
                background: #8a8a8a; }

            #email-template-html .header p {
                color: #ffffff;
                margin: 0; }

            #email-template-html .header .columns {
                padding-bottom: 0; }

            #email-template-html .header .container {
                background: #8a8a8a;
                padding-top: 16px;
                padding-bottom: 16px; }

            #email-template-html .header .container td {
                padding-top: 16px;
                padding-bottom: 16px; }

            #email-template-html .grey {
                background: #f0f0f0; }

            #email-template-html .border-test {
                border: 1px solid #ccc; }

            #email-template-html .masthead {
                background: #212121;
            }

            .swu-logo {
                max-height: 70px;
                width: auto;
                padding: 15px 0px 0px 0px; }

            #email-template-html .masthead h1 {
                color: #ffffff;
                padding: 35px 0px 15px 0px; }

            #email-template-html .column-border {
                border: 1px solid #eee; }

            #email-template-html .footercopy {
                padding: 20px 0px;
                font-size: 12px;
                color: #777777; }

            #email-template-html p {
                color: #777777 !important; }
        </style>

        <style type="text/css" media="only screen and (max-width: 596px)">
            @media only screen and (max-width: 596px) {
                table.body table.container .hide-for-large {
                    display: block !important;
                    width: auto !important;
                    overflow: visible !important; } }

            table.body table.container .hide-for-large * {
                mso-hide: all; }
        </style>

        <style type="text/css" media="only screen and (max-width: 596px)">
            @media only screen and (max-width: 596px) {
                table.body table.container .row.hide-for-large,
                table.body table.container .row.hide-for-large {
                    display: table !important;
                    width: 100% !important; } }
        </style>

        <style type="text/css" media="only screen and (max-width: 596px)">
            @media only screen and (max-width: 596px) {
                table.body table.container .show-for-large {
                    display: none !important;
                    width: 0;
                    mso-hide: all;
                    overflow: hidden; } }
        </style>

        <style type="text/css" media="only screen and (max-width: 596px)">
            @media only screen and (max-width: 596px) {
                table.body img {
                    width: auto !important;
                    height: auto !important; }
                table.body center {
                    min-width: 0 !important; }
                table.body .container {
                    width: 95% !important; }
                table.body .columns,
                table.body .column {
                    height: auto !important;
                    -moz-box-sizing: border-box;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    padding-left: 16px !important;
                    padding-right: 16px !important; }
                table.body .columns .column,
                table.body .columns .columns,
                table.body .column .column,
                table.body .column .columns {
                    padding-left: 0 !important;
                    padding-right: 0 !important; }
                table.body .collapse .columns,
                table.body .collapse .column {
                    padding-left: 0 !important;
                    padding-right: 0 !important; }
                td.small-1,
                th.small-1 {
                    display: inline-block !important;
                    width: 8.33333% !important; }
                td.small-2,
                th.small-2 {
                    display: inline-block !important;
                    width: 16.66667% !important; }
                td.small-3,
                th.small-3 {
                    display: inline-block !important;
                    width: 25% !important; }
                td.small-4,
                th.small-4 {
                    display: inline-block !important;
                    width: 33.33333% !important; }
                td.small-5,
                th.small-5 {
                    display: inline-block !important;
                    width: 41.66667% !important; }
                td.small-6,
                th.small-6 {
                    display: inline-block !important;
                    width: 50% !important; }
                td.small-7,
                th.small-7 {
                    display: inline-block !important;
                    width: 58.33333% !important; }
                td.small-8,
                th.small-8 {
                    display: inline-block !important;
                    width: 66.66667% !important; }
                td.small-9,
                th.small-9 {
                    display: inline-block !important;
                    width: 75% !important; }
                td.small-10,
                th.small-10 {
                    display: inline-block !important;
                    width: 83.33333% !important; }
                td.small-11,
                th.small-11 {
                    display: inline-block !important;
                    width: 91.66667% !important; }
                td.small-12,
                th.small-12 {
                    display: inline-block !important;
                    width: 100% !important; }
                .columns td.small-12,
                .column td.small-12,
                .columns th.small-12,
                .column th.small-12 {
                    display: block !important;
                    width: 100% !important; }
                .body .columns td.small-1,
                .body .column td.small-1,
                td.small-1 center,
                .body .columns th.small-1,
                .body .column th.small-1,
                th.small-1 center {
                    display: inline-block !important;
                    width: 8.33333% !important; }
                .body .columns td.small-2,
                .body .column td.small-2,
                td.small-2 center,
                .body .columns th.small-2,
                .body .column th.small-2,
                th.small-2 center {
                    display: inline-block !important;
                    width: 16.66667% !important; }
                .body .columns td.small-3,
                .body .column td.small-3,
                td.small-3 center,
                .body .columns th.small-3,
                .body .column th.small-3,
                th.small-3 center {
                    display: inline-block !important;
                    width: 25% !important; }
                .body .columns td.small-4,
                .body .column td.small-4,
                td.small-4 center,
                .body .columns th.small-4,
                .body .column th.small-4,
                th.small-4 center {
                    display: inline-block !important;
                    width: 33.33333% !important; }
                .body .columns td.small-5,
                .body .column td.small-5,
                td.small-5 center,
                .body .columns th.small-5,
                .body .column th.small-5,
                th.small-5 center {
                    display: inline-block !important;
                    width: 41.66667% !important; }
                .body .columns td.small-6,
                .body .column td.small-6,
                td.small-6 center,
                .body .columns th.small-6,
                .body .column th.small-6,
                th.small-6 center {
                    display: inline-block !important;
                    width: 50% !important; }
                .body .columns td.small-7,
                .body .column td.small-7,
                td.small-7 center,
                .body .columns th.small-7,
                .body .column th.small-7,
                th.small-7 center {
                    display: inline-block !important;
                    width: 58.33333% !important; }
                .body .columns td.small-8,
                .body .column td.small-8,
                td.small-8 center,
                .body .columns th.small-8,
                .body .column th.small-8,
                th.small-8 center {
                    display: inline-block !important;
                    width: 66.66667% !important; }
                .body .columns td.small-9,
                .body .column td.small-9,
                td.small-9 center,
                .body .columns th.small-9,
                .body .column th.small-9,
                th.small-9 center {
                    display: inline-block !important;
                    width: 75% !important; }
                .body .columns td.small-10,
                .body .column td.small-10,
                td.small-10 center,
                .body .columns th.small-10,
                .body .column th.small-10,
                th.small-10 center {
                    display: inline-block !important;
                    width: 83.33333% !important; }
                .body .columns td.small-11,
                .body .column td.small-11,
                td.small-11 center,
                .body .columns th.small-11,
                .body .column th.small-11,
                th.small-11 center {
                    display: inline-block !important;
                    width: 91.66667% !important; }
                table.body td.small-offset-1,
                table.body th.small-offset-1 {
                    margin-left: 8.33333% !important;
                    Margin-left: 8.33333% !important; }
                table.body td.small-offset-2,
                table.body th.small-offset-2 {
                    margin-left: 16.66667% !important;
                    Margin-left: 16.66667% !important; }
                table.body td.small-offset-3,
                table.body th.small-offset-3 {
                    margin-left: 25% !important;
                    Margin-left: 25% !important; }
                table.body td.small-offset-4,
                table.body th.small-offset-4 {
                    margin-left: 33.33333% !important;
                    Margin-left: 33.33333% !important; }
                table.body td.small-offset-5,
                table.body th.small-offset-5 {
                    margin-left: 41.66667% !important;
                    Margin-left: 41.66667% !important; }
                table.body td.small-offset-6,
                table.body th.small-offset-6 {
                    margin-left: 50% !important;
                    Margin-left: 50% !important; }
                table.body td.small-offset-7,
                table.body th.small-offset-7 {
                    margin-left: 58.33333% !important;
                    Margin-left: 58.33333% !important; }
                table.body td.small-offset-8,
                table.body th.small-offset-8 {
                    margin-left: 66.66667% !important;
                    Margin-left: 66.66667% !important; }
                table.body td.small-offset-9,
                table.body th.small-offset-9 {
                    margin-left: 75% !important;
                    Margin-left: 75% !important; }
                table.body td.small-offset-10,
                table.body th.small-offset-10 {
                    margin-left: 83.33333% !important;
                    Margin-left: 83.33333% !important; }
                table.body td.small-offset-11,
                table.body th.small-offset-11 {
                    margin-left: 91.66667% !important;
                    Margin-left: 91.66667% !important; }
                table.body table.columns td.expander,
                table.body table.columns th.expander {
                    display: none !important; }
                table.body .right-text-pad,
                table.body .text-pad-right {
                    padding-left: 10px !important; }
                table.body .left-text-pad,
                table.body .text-pad-left {
                    padding-right: 10px !important; }
                table.menu {
                    width: 100% !important; }
                table.menu td,
                table.menu th {
                    width: auto !important;
                    display: inline-block !important; }
                table.menu.vertical td,
                table.menu.vertical th, table.menu.small-vertical td,
                table.menu.small-vertical th {
                    display: block !important; }
                table.menu[align="center"] {
                    width: auto !important; }
                table.button.expand {
                    width: 100% !important; }
            }
        </style>

        <style type="text/css" media="only screen and (max-width: 596px)">
            @media only screen and (max-width: 596px) {
                .small-float-center {
                    margin: 0 auto !important;
                    float: none !important;
                    text-align: center !important; }
                .small-text-center {
                    text-align: center !important; }
                .small-text-left {
                    text-align: left !important; }
                .small-text-right {
                    text-align: right !important; }
            }
        </style>

        <style>
            .features tr td{
                padding: 5px 0;;
            }
        </style>

    </head>
    <body>
    <table class="body">
        <tr>
            <td class="center" align="center" valign="top">
                <center data-parsed="">
                    <table class="container text-center"><tbody><tr><td> <!-- This container adds the grey gap at the top of the email -->
                                <table class="row grey"><tbody><tr>
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        &#xA0;
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                            </td></tr></tbody></table>

                    <table class="container text-center"><tbody><tr><td> <!-- This container is the main email content -->
                                <table class="row"><tbody><tr> <!-- Logo -->
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <center data-parsed="">
                                                            <a  align="center" class="text-center">
                                                                <img id="email-logo-html" src="http://ace.huntplex.com/ace/images/ace-logo-black.png" class="swu-logo">
                                                            </a>
                                                        </center>
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                                <table class="row masthead"><tbody><tr> <!-- Masthead -->
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h1 id="email-heading-html" class="text-center">This Is Email Heading!</h1>
                                                        <center data-parsed="">
                                                            <img src="http://ace.huntplex.com/ace/images/slider2.jpg" valign="bottom" align="center" class="text-center">
                                                        </center>
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                                <table class="row"><tbody><tr> <!--This container adds the gap between masthead and digest content -->
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        &#xA0;
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                                <table class="row"><tbody><tr> <!-- main Email content -->
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <b><h5>Hi!</h5></b>
                                                        <p id="email-content-html">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                        <br>

                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                                <table class="row"><tbody><tr> <!-- This container adds whitespace gap at the bottom of main content  -->
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        &#xA0;
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                            </td></tr></tbody></table>  <!-- end main email content -->

                    <table class="container text-center"><tbody><tr><td> <!-- footer -->
                                <table class="row grey"><tbody><tr>
                                        <th class="small-12 large-12 columns first last">
                                            <table>
                                                <tr>
                                                    <th>
                                                        <p class="text-center footercopy">&#xA9; Copyright 2016 YOUR BUSINESS NAME. All Rights Reserved.</p>
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr></tbody></table>
                            </td></tr></tbody></table>



                </center>
            </td>
        </tr>
    </table>
    </body>
    </html>'
            ]
        ];

        foreach($emailTemplates as $emailTemplate => $data) {
            GymEmailTemplates::create([
                'template_name' => $emailTemplate,
                'description' => $data[0],
                'image' => $data[1],
                'html_template' => $data[2],
                'preview_template' => $data[3],
            ]);
        }
    }
}

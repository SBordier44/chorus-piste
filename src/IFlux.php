<?php
declare(strict_types=1);

namespace PhpChorusPiste;


interface IFlux
{
    public const IN_DP_E1_UBL_INVOICE = 'IN_DP_E1_UBL_INVOICE';
    public const IN_DP_E1_CII = 'IN_DP_E1_CII';
    public const IN_DP_E1_PES_FACTURE = 'IN_DP_E1_PES_FACTURE';
    public const IN_DP_E1_XCBL = 'IN_DP_E1_XCBL';
    public const IN_DP_E1_CII_16B = 'IN_DP_E1_CII_16B';
    public const IN_DP_E2_UBL_INVOICE_MIN = 'IN_DP_E2_UBL_INVOICE_MIN';
    public const IN_DP_E2_CII_MIN = 'IN_DP_E2_CII_MIN';
    public const IN_DP_E2_PES_FACTURE_MIN = 'IN_DP_E2_PES_FACTURE_MIN';
    public const IN_DP_E2_CPP_FACTURE_MIN = 'IN_DP_E2_CPP_FACTURE_MIN';
    public const IN_DP_E2_CII_FACTURX = 'IN_DP_E2_CII_FACTURX';
    public const IN_DP_E2_CII_MIN_16B = 'IN_DP_E2_CII_MIN_16B';
}

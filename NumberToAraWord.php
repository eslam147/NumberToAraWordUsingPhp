<?php
function NumberToWord($num , $moneyType = null , $SubMoneyType = Null) {
    /* Start Processing the Arrays needed to convert numbers into text */
        $Unites = [
            'صفر',
            'واحد',
            'إثنان',
            'ثلاثة',
            'أربعة',
            'خمسة',
            'ستة',
            'سبعة',
            'ثمانية',
            'تسعة',
        ];
        $tens = [
            'عشرة',
            'عشر',
            'عشرون',
            'ثلاثون',
            'أربعون',
            'خمسون',
            'ستون',
            'سبعون',
            'ثمانون',
            'تسعون',
        ];
        $handreds = [
            'صفر',
            'مائة',
            'مائتان',
            'ثلاثمائة',
            'أربعمائة',
            'خمسمائة',
            'ستمائة',
            'سبعمائة',
            'ثمانمائة',
            'تسعمائة',
        ];
        $thousands = [
            'صفر',
            "ألف",
            "ألفان",
            "آلاف",
            "ألفًا"    
        ];
        $millions = [
            'صفر',
            "مليون",
            "مليونان",
            "ملايين",
            "مليونًا"    
        ];
        $billions = [
            'صفر',
            "مليار",
            "ملياران",
            "مليارات",
            "مليارًا"    
        ];
        $trillions = [
            'صفر',
            "تريليون",
            "تريليونان",
            "تريليونات",
            "تريليونًا"    
        ];
    /* End Processing the Arrays needed to convert numbers into text */
    $round = round($num,2);
    $numberFormat = number_format($round,2,".",",");
    $explode = explode(".",$numberFormat);
    $wholeNumber = $explode[0];
    $descmalNumber = end($explode);
    $arr_rev = array_reverse(explode(",",$wholeNumber));
    ksort($arr_rev);
    $retext = "";
    $retext1 = "";
    $arr = [];
    /* Start Convert Number To Text */
        foreach($arr_rev as $key => $i) { 
            if($key > 0) {
                /* Start Convert trillions Number To Text */
                    if($key == 4) {
                        if($i == 1) {
                            $arr[] = $trillions[1];
                        } elseif($i == 2) {
                            $arr[] = $trillions[2];
                        } elseif($i > 2 && $i < 10) {
                            $arr[] = $Unites[substr($i,-1,1)]." ".$trillions[3];
                        } elseif($i > 2 && $i == 10) {
                            $arr[] = $tens[substr($i,-1,1)]." ".$trillions[3];
                        } elseif($i > 10 && $i < 100) {
                            if(substr($i,2,1) > 0 && substr($i,2,1) == 1) {
                                $Unites[1] = "أحدى";
                            } if(substr($i,2,1) > 0 && substr($i,2,1) == 2) {
                                $Unites[2] = "إثنى";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 1) {
                                $Unites[1] = "أحد";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 2) {
                                $Unites[2] = "إثنا";
                            }
                            if($i > 19) {
                                if(trim($Unites[substr($i,1,1)]) != "صفر") {
                                    $arr[] = $Unites[substr($i,1,1)]." و ".$tens[substr($i,0,1)]." ".$trillions[4];
                                } else {
                                    $arr[] = $tens[substr($i,0,1)]." ".$trillions[4];
                                }
                            } else {
                                $arr[] = $Unites[substr($i,1,1)]." ".$tens[substr($i,0,1)]." ".$trillions[4];
                            }
                        } elseif($i == 100) {
                            $arr[] = $handreds[substr($i,0,1)]." ".$trillions[1];
                        } elseif($i > 100 && $i < 1000) {
                            if(substr($i,2,1) == 1 && substr($i,1,1) < 2 && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأحد ". $tens[substr($i,1,1)]." ".$trillions[4];
                            }elseif(substr($i,2,1) == 0 && substr($i,1,1) == 1) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,-1,1)]." ".$trillions[3];
                            } elseif (substr($i,2,1) == 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأثنا ". $tens[substr($i,1,1)]." ".$trillions[4];
                            } elseif(substr($i,2,1) > 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$tens[substr($i,1,1)]." ".$trillions[4];
                            } else {
                                if(substr($i,2,1) != 0) {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." و".$tens[substr($i,1,1)]." ".$trillions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$trillions[4];
                                    }
                                } else {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,1,1)]." ".$trillions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." ".$trillions[4];
                                    }
                                }
                            }    
                        }
                    }
                /* End Convert trillions Number To Text */
                /* Start Convert billions Number To Text */
                    if($key == 3) {
                        if($i == 1) {
                            $arr[] = $billions[1];
                        } elseif($i == 2) {
                            $arr[] = $billions[2];
                        } elseif($i > 2 && $i < 10) {
                            $arr[] = $Unites[substr($i,-1,1)]." ".$billions[3];
                        } elseif($i > 2 && $i == 10) {
                            $arr[] = $tens[substr($i,-1,1)]." ".$billions[3];
                        } elseif($i > 10 && $i < 100) {
                            if(substr($i,2,1) > 0 && substr($i,2,1) == 1) {
                                $Unites[1] = "أحدى";
                            } if(substr($i,2,1) > 0 && substr($i,2,1) == 2) {
                                $Unites[2] = "إثنى";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 1) {
                                $Unites[1] = "أحد";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 2) {
                                $Unites[2] = "إثنا";
                            }
                            if($i > 19) {
                                if(trim($Unites[substr($i,1,1)]) != "صفر") {
                                    $arr[] = $Unites[substr($i,1,1)]." و ".$tens[substr($i,0,1)]." ".$billions[4];
                                } else {
                                    $arr[] = $tens[substr($i,0,1)]." ".$billions[4];
                                }
                            } else {
                                $arr[] = $Unites[substr($i,1,1)]." ".$tens[substr($i,0,1)]." ".$billions[4];
                            }
                        } elseif($i == 100) {
                            $arr[] = $handreds[substr($i,0,1)]." ".$billions[1];
                        } elseif($i > 100 && $i < 1000) {
                            if(substr($i,2,1) == 1 && substr($i,1,1) < 2 && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأحد ". $tens[substr($i,1,1)]." ".$billions[4];
                            }elseif(substr($i,2,1) == 0 && substr($i,1,1) == 1) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,-1,1)]." ".$billions[3];
                            } elseif (substr($i,2,1) == 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأثنا ". $tens[substr($i,1,1)]." ".$billions[4];
                            } elseif(substr($i,2,1) > 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$tens[substr($i,1,1)]." ".$billions[4];
                            } else {
                                if(substr($i,2,1) != 0) {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." و".$tens[substr($i,1,1)]." ".$billions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$billions[4];
                                    }
                                } else {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,1,1)]." ".$billions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." ".$billions[4];
                                    }
                                }
                            }    
                        }
                    }
                /* End Convert billions Number To Text */
                /* Start Convert millions Number To Text */
                    if($key == 2) {
                        if($i == 1) {
                            $arr[] = $millions[1];
                        } elseif($i == 2) {
                            $arr[] = $millions[2];
                        } elseif($i > 2 && $i < 10) {
                            $arr[] = $Unites[substr($i,-1,1)]." ".$millions[3];
                        } elseif($i > 2 && $i == 10) {
                            $arr[] = $tens[substr($i,-1,1)]." ".$millions[3];
                        } elseif($i > 10 && $i < 100) {
                            if(substr($i,2,1) > 0 && substr($i,2,1) == 1) {
                                $Unites[1] = "أحدى";
                            } if(substr($i,2,1) > 0 && substr($i,2,1) == 2) {
                                $Unites[2] = "إثنى";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 1) {
                                $Unites[1] = "أحد";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 2) {
                                $Unites[2] = "إثنا";
                            }
                            if($i > 19) {
                                if(trim($Unites[substr($i,1,1)]) != "صفر") {
                                    $arr[] = $Unites[substr($i,1,1)]." و ".$tens[substr($i,0,1)]." ".$millions[4];
                                } else {
                                    $arr[] = $tens[substr($i,0,1)]." ".$millions[4];
                                }
                            } else {
                                $arr[] = $Unites[substr($i,1,1)]." ".$tens[substr($i,0,1)]." ".$millions[4];
                            }
                        } elseif($i == 100) {
                            $arr[] = $handreds[substr($i,0,1)]." ".$millions[1];
                        } elseif($i > 100 && $i < 1000) {
                            if(substr($i,2,1) == 1 && substr($i,1,1) < 2 && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأحد ". $tens[substr($i,1,1)]." ".$millions[4];
                            }elseif(substr($i,2,1) == 0 && substr($i,1,1) == 1) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,-1,1)]." ".$millions[3];
                            } elseif (substr($i,2,1) == 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأثنا ". $tens[substr($i,1,1)]." ".$millions[4];
                            } elseif(substr($i,2,1) > 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$tens[substr($i,1,1)]." ".$millions[4];
                            } else {
                                if(substr($i,2,1) != 0) {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." و".$tens[substr($i,1,1)]." ".$millions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$millions[4];
                                    }
                                } else {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,1,1)]." ".$millions[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." ".$millions[4];
                                    }
                                }
                            }    
                        }
                    }
                /* End Convert millions Number To Text */
                /* Start Convert thousands Number To Text */
                    if($key == 1) {
                        if($i == 1) {
                            $arr[] = $thousands[1];
                        } elseif($i == 2) {
                            $arr[] = $thousands[2];
                        } elseif($i > 2 && $i < 10) {
                            $arr[] = $Unites[substr($i,-1,1)]." ".$thousands[3];
                        } elseif($i > 2 && $i == 10) {
                            $arr[] = $tens[substr($i,-1,1)]." ".$thousands[3];
                        } elseif($i > 10 && $i < 100) {
                            if(substr($i,2,1) > 0 && substr($i,2,1) == 1) {
                                $Unites[1] = "أحدى";
                            } if(substr($i,2,1) > 0 && substr($i,2,1) == 2) {
                                $Unites[2] = "إثنى";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 1) {
                                $Unites[1] = "أحد";
                            } elseif(!substr($i,2,1) && substr($i,0,1) == 2) {
                                $Unites[2] = "إثنا";
                            }
                            if($i > 19) {
                                if(trim($Unites[substr($i,1,1)]) != "صفر") {
                                    $arr[] = $Unites[substr($i,1,1)]." و ".$tens[substr($i,0,1)]." ".$thousands[4];
                                } else {
                                    $arr[] = $tens[substr($i,0,1)]." ".$thousands[4];
                                }
                            } else {
                                $arr[] = $Unites[substr($i,1,1)]." ".$tens[substr($i,0,1)]." ".$thousands[4];
                            }
                        } elseif($i == 100) {
                            $arr[] = $handreds[substr($i,0,1)]." ".$thousands[1];
                        } elseif($i > 100 && $i < 1000) {
                            if(substr($i,2,1) == 1 && substr($i,1,1) < 2 && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأحد ". $tens[substr($i,1,1)]." ".$thousands[4];
                            }elseif(substr($i,2,1) == 0 && substr($i,1,1) == 1) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,-1,1)]." ".$thousands[3];
                            } elseif (substr($i,2,1) == 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." وأثنا ". $tens[substr($i,1,1)]." ".$thousands[4];
                            } elseif(substr($i,2,1) > 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                                $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$tens[substr($i,1,1)]." ".$thousands[4];
                            } else {
                                if(substr($i,2,1) != 0) {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." و".$tens[substr($i,1,1)]." ".$thousands[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$Unites[substr($i,2,1)]." ".$thousands[4];
                                    }
                                } else {
                                    if(substr($i,1,1) > 0) {
                                        $arr[] = $handreds[substr($i,0,1)]." و".$tens[substr($i,1,1)]." ".$thousands[4];
                                    } else {
                                        $arr[] = $handreds[substr($i,0,1)]." ".$thousands[4];
                                    }
                                }
                            }    
                        }
                    }
                /* End Convert thousands Number To Text */
            }
            /* Start Convert UnitesToHandreds Number To Text */
                if($key == 0) {
                    if($i < 10) {
                        if(substr($i,2,1) && substr($i,2,1) != 0) {
                            $retext.= $Unites[substr($i,2,1)];
                        } else {
                            @$retext.= $Unites[$i];
                        }
                    }elseif($i == 10) {
                        $retext.= $tens[0];
                    } elseif($i > 10 && $i < 100) {
                    /* Start Check if Number More Than Handreds Or Not */
                        if(substr($i,2,1) > 0 && substr($i,2,1) == 1) {
                            $Unites[1] = "أحدى";
                            $retext.= $Unites[substr($i,2,1)];
                        } if(substr($i,2,1) > 0 && substr($i,2,1) == 2) {
                            $Unites[2] = "إثنى";
                            $retext.= $Unites[substr($i,2,1)];
                        } elseif(substr($i,2,1) > 0 && substr($i,2,1) > 2) {
                            $retext.= $Unites[substr($i,2,1)];
                        } elseif(!substr($i,2,1) && substr($i,1,1) == 1) {
                            $Unites[1] = "أحد";
                            $retext.= $Unites[substr($i,1,1)];
                        } elseif(!substr($i,2,1) && substr($i,1,1) == 2) {
                            $Unites[2] = "إثنا";
                            $retext.= $Unites[substr($i,1,1)];
                        } elseif(!substr($i,2,1) && substr($i,1,1) > 2) {
                            $retext.= $Unites[substr($i,1,1)];
                        }
                    /* End Check if Number More Than Handreds Or Not */
                        if($i > 19) {
                        /* Start Check if Number More Than Handreds Or Not */
                            if(substr($i,2,1) && substr($i,2,1) != 0) {
                                $retext.= " و".$tens[substr($i,1,1)];
                            } else {
                                $retext.= " و".$tens[substr($i,0,1)];
                            }
                        /* End Check if Number More Than Handreds Or Not */
                        } else {
                        /* Start Check if Number More Than Handreds Or Not */
                            if(substr($i,2,1) && substr($i,2,1) != 0) {
                                $retext.= " ".$tens[substr($i,1,1)];
                            } else {
                                $retext.= " ".$tens[substr($i,0,1)];
                            }
                        /* End Check if Number More Than Handreds Or Not */
                        }
                    } elseif($i == 100) {
                        $retext.= " ".$handreds[substr($i,0,1)];
                    } elseif($i > 100 && $i < 1000) {
                    /* Start Handreds Numbers */
                        $retext.= " ".$handreds[substr($i,0,1)];
                        if(substr($i,2,1) == 1 && substr($i,1,1) < 2 && substr($i,1,1) > 0) {
                            $retext.= " وأحد ";
                            $retext.= $tens[substr($i,1,1)];
                        }elseif(substr($i,2,1) == 0 && substr($i,1,1) == 1) {
                            $retext.= " و".$tens[substr($i,-1,1)];
                        } elseif (substr($i,2,1) == 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                            $retext.= " وأثنا ";
                            $retext.= $tens[substr($i,1,1)];
                        } elseif(substr($i,2,1) > 2 && substr($i,1,1) < 2  && substr($i,1,1) > 0) {
                            $retext.= "و ".$Unites[substr($i,2,1)];
                            $retext.= " ".$tens[substr($i,1,1)];
                        } else {
                            if(substr($i,2,1) != 0) {
                                $retext.= " و".$Unites[substr($i,2,1)];
                            }
                            $retext.= " و".$tens[substr($i,1,1)];
                        }
                    /* End Handreds Numbers */
                    }
                    $arr[] = $retext;
                }
            /* End Convert UnitesToHandreds Number To Text */
        }
    /* End Convert Number To Text */
    /* Start Convert Decimal To Text */
        $strsplit = array_reverse(explode(",",$descmalNumber));
        ksort($strsplit);
        foreach($strsplit as $key => $i) {
            if($i < 10) {
                $retext1.= $Unites[$i];
            }elseif($i == 10) {
                $retext1.= $tens[0];
            } elseif($i > 10 && $i < 100) {
                if(substr($i,0,1) == 1 && substr($i,1,1) == 1) {
                    $Unites[1] = "أحد";
                    $retext1.= $Unites[substr($i,1,1)];
                } elseif(substr($i,0,1) == 1 && substr($i,1,1) == 2) {
                    $Unites[2] =  "إثنا";
                    $retext1.= $Unites[substr($i,1,1)];
                } elseif(substr($i,1,1) > 2) {
                    $retext1.= $Unites[substr($i,1,1)];
                }
                if($i > 19) {
                    if(substr($i,1,1) != 0) {
                        $retext1.= " و".$tens[substr($i,0,1)];
                    } else {
                        $retext1.= " ".$tens[substr($i,0,1)];
                    }
                } else {
                    $retext1.= " ".$tens[substr($i,0,1)];
                }
            }
        }
    /* Start Convert Decimal To Text */
    /* Return Converted Number  */
        $imp = implode(" و",array_filter(array_reverse($arr)));
        if($moneyType != Null) {
            if($retext1 != "" && $SubMoneyType != null) {
                $GetNumberWord = $imp." ".$moneyType." و ".$retext1." ".$SubMoneyType;
            } elseif($retext1 != "" && $SubMoneyType == null) {
                $GetNumberWord = $imp." ".$moneyType." و ".$retext1;
            }
        } else {
            if($retext1 != "" && $SubMoneyType != null) {
                $GetNumberWord = $imp." و ".$retext1." ".$SubMoneyType;
            } else {
                $GetNumberWord = $imp;
            }
        }
        return $GetNumberWord;
}
$number = 2685.19; 
echo $number."<br>";    // This Is Print Number Before Convert Arabic Text
echo NumberToWord($number); // This Is Print Number After Convert Arabic Text
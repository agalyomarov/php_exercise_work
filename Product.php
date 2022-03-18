<?php
class Product
{
   public  $products = [];
   public  $user_products = [];
   public  $total_sum = 0;
   function __construct($products)
   {
      $this->products = $products;
   }
   public function checkProducts(...$check_products)
   {
      $this->user_products = $check_products;

      if (in_array('A', $check_products) && in_array('B', $check_products)) {
         $this->firstRule();
      }

      if (in_array('D', $check_products) && in_array('E', $check_products)) {
         $this->secondRule();
      }

      if (in_array('E', $check_products) && in_array('F', $check_products) && in_array('G', $check_products)) {
         $this->thirdRule();
      }

      if (in_array('A', $check_products) && (in_array('K', $check_products) || in_array('L', $check_products) || in_array('M', $check_products))) {
         $this->fourthRule();
      }

      if (count($check_products) == 3) {
         $this->fifthSixRule(5);
      }

      if (count($check_products) == 4) {
         $this->fifthSixRule(10);
      }
   }

   private function firstRule()
   {
      $total_sum_for_A_B = 0;
      $key_of_A = 0;

      foreach ($this->user_products as $key => $value) {
         if ($value == 'A' && in_array('B', $this->user_products)) {
            $total_sum_for_A_B += $this->products[$value];
            $key_of_A = $key;
         } elseif ($value == 'B' && in_array('A', $this->user_products)) {
            $total_sum_for_A_B += $this->products[$value];
            unset($this->user_products[$key]);
            unset($this->user_products[$key_of_A]);
         }
      }
      $this->total_sum += ($total_sum_for_A_B * 90) / 100;
   }

   private function secondRule()
   {
      $total_sum_for_D_E = 0;
      $key_of_D = 0;

      foreach ($this->user_products as $key => $value) {
         if ($value == 'D' && in_array('E', $this->user_products)) {
            $total_sum_for_D_E += $this->products[$value];
            $key_of_D = $key;
         } elseif ($value == 'E' && in_array('D', $this->user_products)) {
            $total_sum_for_D_E += $this->products[$value];
            unset($this->user_products[$key]);
            unset($this->user_products[$key_of_D]);
         }
      }
      $this->total_sum += ($total_sum_for_D_E * 94) / 100;
   }

   private function thirdRule()
   {
      $total_sum_for_E_F_G = 0;
      $key_of_E = 0;
      $key_of_F = 0;

      foreach ($this->user_products as $key => $value) {
         if ($value == 'E' && in_array('F', $this->user_products) && in_array('G', $this->user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            $key_of_E = $key;
         } elseif ($value == 'F' && in_array('E', $this->user_products) && in_array('G', $this->user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            $key_of_F = $key;
         } elseif ($value == 'G' && in_array('E', $this->user_products) && in_array('F', $this->user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            unset($this->user_products[$key]);
            unset($this->user_products[$key_of_E]);
            unset($this->user_products[$key_of_F]);
         }
      }
      $this->total_sum += ($total_sum_for_E_F_G * 97) / 100;
   }

   private function fourthRule()
   {
      $total_sum_for_A_or_K_L_M = 0;

      foreach ($this->user_products as $key => $value) {
         if ($value == 'A' && (in_array('K', $this->user_products) || in_array('L', $this->user_products) || in_array('M', $this->user_products))) {
            $total_sum_for_A_or_K_L_M += $this->products[$value];
            unset($this->user_products[$key]);
         }
      }
      $this->total_sum += ($total_sum_for_A_or_K_L_M * 95) / 100;
   }

   private function fifthSixRule($p)
   {
      foreach ($this->user_products as $key => $value) {
         if (isset($this->products[$value])) {
            $this->total_sum +=  $this->products[$value];
         }
      }
      $this->total_sum = ($this->total_sum * (100 - $p)) / 100;
   }
}

$products = new Product(['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5, 'F' => 6, 'G' => 7, 'H' => 8, 'I' => 9, 'J' => 10, 'K' => 11, 'L' => 12, 'M' => 13]);

$products->checkProducts('D', 'E', 'L', 'A');

echo $products->total_sum;

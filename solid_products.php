<?php

// ----------------------------------------------------------------
// Я считал будет правильный если здес применят от принципы SOLID первая и вторая принципы
// 1.Принцип единой ответственности.Каждый класс отвечает только за одну действие
// 2.Принцип открытости и закрытости.Модул легко расширяеться
// ----------------------------------------------------------------


class Products
{
   protected  $products = ['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5, 'F' => 6, 'G' => 7, 'H' => 8, 'I' => 9, 'J' => 10, 'K' => 11, 'L' => 12, 'M' => 13]; //Приставым что данный о все продуктов получены из БД
}


class FirstRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      $total_sum_for_A_B = 0;
      $key_of_A = 0;
      foreach ($user_products as $key => $value) {
         if ($value == 'A' && in_array('B', $user_products)) {
            $total_sum_for_A_B += $this->products[$value];
            $key_of_A = $key;
         } elseif ($value == 'B' && in_array('A', $user_products)) {
            $total_sum_for_A_B += $this->products[$value];
            unset($user_products[$key]);
            unset($user_products[$key_of_A]);
         }
      }
      $total_sum += ($total_sum_for_A_B * 90) / 100;
      return [$user_products, $total_sum];
   }
}

class SecondRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      $total_sum_for_D_E = 0;
      $key_of_D = 0;
      foreach ($user_products as $key => $value) {
         if ($value == 'D' && in_array('E', $user_products)) {
            $total_sum_for_D_E += $this->products[$value];
            $key_of_D = $key;
         } elseif ($value == 'E' && in_array('D', $user_products)) {
            $total_sum_for_D_E += $this->products[$value];
            unset($user_products[$key]);
            unset($user_products[$key_of_D]);
         }
      }
      $total_sum += ($total_sum_for_D_E * 94) / 100;
      return [$user_products, $total_sum];
   }
}

class ThirdRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      $total_sum_for_E_F_G = 0;
      $key_of_E = 0;
      $key_of_F = 0;
      foreach ($user_products as $key => $value) {
         if ($value == 'E' && in_array('F', $user_products) && in_array('G', $user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            $key_of_E = $key;
         } elseif ($value == 'F' && in_array('E', $user_products) && in_array('G', $user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            $key_of_F = $key;
         } elseif ($value == 'G' && in_array('E', $user_products) && in_array('F', $user_products)) {
            $total_sum_for_E_F_G += $this->products[$value];
            unset($user_products[$key]);
            unset($user_products[$key_of_E]);
            unset($user_products[$key_of_F]);
         }
      }
      $total_sum += ($total_sum_for_E_F_G * 97) / 100;
      return [$user_products, $total_sum];
   }
}

class FourthRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      $total_sum_for_A_or_K_L_M = 0;
      foreach ($user_products as $key => $value) {
         if ($value == 'A' && (in_array('K', $user_products) || in_array('L', $user_products) || in_array('M', $user_products))) {
            $total_sum_for_A_or_K_L_M += $this->products[$value];
            unset($user_products[$key]);
         }
      }
      $total_sum += ($total_sum_for_A_or_K_L_M * 95) / 100;
      return [$user_products, $total_sum];
   }
}

class FifthRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      if (count($user_products) == 3) {
         foreach ($user_products as $key => $value) {
            if (isset($this->products[$value])) {
               $total_sum +=  $this->products[$value];
            }
         }
         $total_sum = ($total_sum * 95) / 100;
      }
      return [$user_products, $total_sum];
   }
}

class SixthRule extends Products
{
   public function changeUserProcducts($user_products, $total_sum)
   {
      if (count($user_products) == 4) {
         foreach ($user_products as $key => $value) {
            if (isset($this->products[$value])) {
               $total_sum +=  $this->products[$value];
            }
         }
         $total_sum = ($total_sum * 90) / 100;
      }
      return [$user_products, $total_sum];
   }
}

$list_rules = [new FirstRule, new SecondRule, new ThirdRule, new FourthRule, new FifthRule, new SixthRule];

$user_products = ['A', 'B']; //Продукты у пользователа

function getTotalSum($list_rules, $user_products)
{
   $total_sum = 0;
   foreach ($list_rules as $key => $value) {
      [$user_products, $total_sum] =  $list_rules[$key]->changeUserProcducts($user_products, $total_sum);
   }
   return $total_sum;
}

echo getTotalSum($list_rules, $user_products);

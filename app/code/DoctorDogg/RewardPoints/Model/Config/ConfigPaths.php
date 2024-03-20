<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Config;

/**
 * Class that provides constants for accessing settings values from the admin panel.
 *
 * @package DoctorDogg\RewardPoints\Model\Config
 */
class ConfigPaths
{
    const USE_SIMPLE_SYSTEM_LIMIT_USAGE_REWARD_POINTS_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/use_simple_system_limit_usage_reward_points';
    const LIMITING_WAY_REWARD_POINTS_USAGE_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/limiting_way_reward_points_usage';
    const N_REWARDS_POINTS_PER_ORDER_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/n_reward_points_per_order';
    const N_PERCENTS_OF_ORDER_PRICE_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/n_percent_of_order_price';
    const NOTIFY_DAYS_BEFORE_EXPIRED_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/notify_days_before_expired';
    const WHEN_APPLY_REWARD_POINTS_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/when_apply_reward_points';
    const DISPLAY_PRODUCT_REWARD_POINTS_PATH = 'doctordogg_rewardpoints_settings/rewardpoints_settings/display_product_reward_points';
}

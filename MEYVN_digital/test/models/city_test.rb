require 'test_helper'

class CityTest < ActiveSupport::TestCase
  def setup
    @city = City.new
  end

  test 'City should be unique, not nll and not case sensitive' do
    city_to_save = City.new
    assert_not_nil city_to_save
    city_to_save.name = ''
    assert_not city_to_save.valid?

    city_to_save.name = 'Moscow'
    assert city_to_save.valid?
    assert_difference 'City.count', 1 do
      city_to_save.save
    end

    city_to_save = City.new
    city_to_save.name = 'MoScOw'
    assert_no_difference 'City.count' do
      city_to_save.save
    end

    city_to_save.name = 'St.Petersburg'
    assert_difference 'City.count', 1 do
      city_to_save.save
    end
  end
end
